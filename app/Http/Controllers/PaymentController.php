<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Action\NotificationController;

use App\Http\Requests\Event\BookingRequest;
use App\Http\Requests\Event\CalculateInvoiceAmountRequest;
use App\Http\Requests\Event\CancelBookingRequest;
use App\Http\Requests\Event\ConfirmPaymentRequest;
use App\Http\Requests\Event\ResellTicketRequest;
use App\Models\Action\Notification;
use App\Models\Event\Booking;
use App\Models\Event\Event;
use App\Models\Invoice;
use App\Models\Event\EventClass;
use App\Models\Event\CancelledBooking;
use App\Models\PromoCode\PromoCode;
use App\Models\User\MobileUser;
use App\Services\api\BookingService;
use App\Services\ECashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    protected $ECashService;
    protected $bookingService;

    public function __construct(ECashService $ECashService, BookingService $bookingService)
    {
        $this->ECashService = $ECashService;
        $this->bookingService = $bookingService;

    }

    public function terminalActivation()
    {
        $this->ECashService->terminalActivation();
    }

    private function calculateTotalInvoiceAmount($request)
    {
        //Normal Ticket
        $ticket_class_price = EventClass::find($request['class_id'])->ticket_price ;

        //Additional Option
        $totalAmenityPrice = 0 ;

        //check if the event has an offer
        $event = Event::find($request['event_id']) ;
        $offer = $event->offer;
        if ($offer) {
            if ($offer->discount_type === 'percent') {
                $offer_discount = ($ticket_class_price * $offer->discount / 100);
            } elseif ($offer->discount_type === 'amount') {
                $offer_discount = $offer->discount;
            }
        }
        
            
        foreach ($request->input('options') as $amenityId) {
            $amenityPrice = $event->amenities()->wherePivot('amenity_id', $amenityId)->first()->pivot->price ?? null;
            $totalAmenityPrice = $amenityPrice + $totalAmenityPrice ;
        }

        //Total Price With amenity

        //calculate discount
        $user = Auth::user() ;
        
        if(isset($request['promo_code_id']))
        {
            if (!$user->hasPromoCode($request['promo_code_id'])) {
                throw new \Exception("User does not have the specified promo code");
            }

            if (!$event->allowsPromoCode($request['promo_code_id'])) {
                throw new \Exception("The event does not allow the specified promo code");
            }

            $promo_code = PromoCode::find($request['promo_code_id']) ;

            $promo_code_discount = ($promo_code->discount * $ticket_class_price)/100 ;
            if($promo_code_discount > $promo_code->limit)
            {
                $promo_code_discount = $promo_code->limit ;
            }
        }
        
        
        if ($event->discount_type === 'percent') {
                $ticket_class_price += ($ticket_class_price * $event->app_taxes / 100);
            } elseif ($event->discount_type === 'amount') {
                $ticket_class_price += $event->app_taxes;
            }
            
            
        $total_price = $ticket_class_price + $totalAmenityPrice  ;
        
        if($offer){
          $total_price -= $offer_discount;
        }
        
        if(isset($request['promo_code_id']) && $user->hasPromoCode($request['promo_code_id']) && $event->allowsPromoCode($request['promo_code_id']) ){
          $total_price -= $promo_code_discount;
        }

        $total_price += intval( $event->ecash_taxes);
        

        return [
            'event_price_with_discount' => intval( $total_price),
            'app_taxes' => intval( $event->app_taxes),
            'ecash_taxes' => intval( $event->ecash_taxes),
            'total' => intval( $total_price)
        ];

    }

    public function calculate_invoice_amount(CalculateInvoiceAmountRequest $request)
    {
        try {
            $calculationResults = $this->calculateTotalInvoiceAmount($request);
        }catch (\Throwable $exception)
        {
            return response()->json([
                'status' => false ,
                'message' => $exception->getMessage()
            ]) ;
        }
        return response()->json(array_merge(['status' => true], $calculationResults));
    }

   public function checkoutWithECash(BookingRequest $request)
{
    DB::beginTransaction();
    $calculationResults = $this->calculateTotalInvoiceAmount($request);
    $request->merge(['class_ticket_price' => $calculationResults['event_price_with_discount']]);
    $bookingResponse = $this->bookingService->book($request);

    if ($bookingResponse['status'] === true) {
        $bookingId = $bookingResponse['booking_id'];
        //$invoiceResponse = $this->ECashService->checkoutWithECash($calculationResults['total'], $bookingId);
        $invoiceResponse = $this->ECashService->checkoutWithECash(1550, $bookingId);
        DB::commit();
        return response()->json([
                'status' => true ,
                'message' => 'Success',
                'url' => $invoiceResponse
            ]) ;
        //return $invoiceResponse;
    } else {
        DB::rollBack();
        return response()->json([
            'status' => false,
            'Message' => 'Error in create the ticket'
        ]);
    }
}


    public function ecashCallback(Request $request)
    {
    
        DB::beginTransaction();
        $data = $request->all();
        //dd($data);
        $token = strtoupper(md5(env('ECASH_MERCHANT_ID') . env('ECASH_MERCHANT_SECRET') . $data['TransactionNo'] . $data['Amount'] . $data['OrderRef']));
        if ($data['Token'] === $token && $data['IsSuccess']) {
            $invoice = Invoice::create([
            'mobile_user_id' => Auth::id() ,
            'amount' => $data['Amount'],
            'description' => 'Booking Process',
            'external_id' => $data['TransactionNo']
            ]);
            
            $book = Booking::withoutGlobalScopes()->find($data['OrderRef']);
            
                    $book->update([
                        'status' => 'paid',
                        'invoice_id' => $data['TransactionNo']
                    ]);
                
            
            DB::commit();
            try {
                Notification::create([
                    'title' => 'Booked Successfully',
                    'description' => 'You have booked Successfully in event',
                    'user_id' => $book->user_id ,
                    'title_ar' => 'تم الحجز بنجاح',
                    'description_ar' => 'تم الحجز بنجاح', 'لقد تم تأكيد حجزك بنجاح في الحدث'
                ]);
                $notificationController = new NotificationController();
                $notificationController->sentNotification($book->user_id, 'Booked Successfully', 'You have booked Successfully in event'
                    , 'تم الحجز بنجاح', 'لقد تم تأكيد حجزك بنجاح في الحدث');
            } catch (\Throwable $exception) {}
            
        return response()->json([
            'status' => true
        ]);
            
        } else {
            //$this->RestoreTicket($request);
            return response()->json([
                'status' => false
                //'Message' => 'Error in confirm the payment'
           ]);
        }

    }
    
    public function paymentSuccess(Request $request)
    {
        DB::beginTransaction();
       // if(! $this->updateStatus($request))
        //{
        //    $this->RestoreTicket($request);
        ////    return response()->json([
       //         'status' => false,
        //        'Message' => 'Error in confirm the payment'
       //     ]);
        //}
        return redirect()->route('dashboard');

    }


    private function RestoreTicket(Request $request): void
    {
        $ids = $request->input('ids');
        foreach ($ids as $id) {
            $book = Booking::withoutGlobalScopes()->find($id);
            if ($book) {
                $class = EventClass::find($book->class_id);
                $class->update(['ticket_number' => $class->ticket_number + 1]);
                $book->delete();
            }
        }
    }

    private function updateStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $user= Auth::user() ;
            $event = Event::find($request['event_id']) ;
            $ids = $request->input('ids');
            foreach ($ids as $id) {
                $book = Booking::withoutGlobalScopes()->find($id);
                if ($book) {
                    $book->update([
                        'status' => 'paid',
                        'invoice_id' => $request['invoice_id']
                    ]);
                }
            }
            if(isset($request['promo_code_id']))
            {
                if (!$user->hasPromoCode($request['promo_code_id'])) {
                    throw new \Exception("User does not have the specified promo code");
                }

                if (!$event->allowsPromoCode($request['promo_code_id'])) {
                    throw new \Exception("The event does not allow the specified promo code");
                }
                $user->promoCodes()->detach($request['promo_code_id']);
            }
            DB::commit();
            return [true];
        }catch (\Throwable $exception){
            DB::rollBack();
            return [false];
        }
    }
    

    public function cancelBooking(CancelBookingRequest $request)
    {
        $booking = Booking::with('event')->withoutGlobalScopes()->findOrFail($request->id);

        $event = Event::withTrashed()->withoutGlobalScopes()->find($booking->event_id);
        if (!$booking) {
            return response()->json([
                'status' => false,
                'message' => 'Booking not found'
            ]);
        }
    
        // Assuming Booking has a relation to Event
        //$event = $booking->event;
    
        if (!$event) {
            return response()->json([
                'status' => false,
                'message' => 'Event not found for this booking'
            ]);
        }
        //dd($booking);
         $now = now(); // Current time
          $bookingCreatedAt = $booking->created_at;
      
          $hoursDifference = $now->diffInHours($bookingCreatedAt);

          if ($hoursDifference > 6) {
           $invoice = Invoice::where('external_id', $booking->invoice_id)->first();
            
            $amount = $invoice ? $invoice->amount : 0;
          $cancelledBookingData = [
                'user_id' => $booking->user_id,
                'event_id' => $booking->event_id,
                'user_phone_number' => $booking->user_phone_number,
                'event_title' => $booking->event_title,
                'class_type' => $booking->class_type,
                'first_name' => $booking->first_name,
                'last_name' => $booking->last_name,
                'age' => $booking->age,
                'phone_number' => $booking->phone_number,
                'amenities' => $booking->amenities,
                'class_ticket_price' => $booking->class_ticket_price,
                'amount' => $amount,
                'reason' => $request->reason,
                'booking_id' => $booking->id,
            ];
            
            if ($booking->promo_code_id !== null) {
                $cancelledBookingData['promo_code_id'] = $booking->promo_code_id;
            }

            $cancelledBooking = CancelledBooking::create($cancelledBookingData);
              return response()->json([
                  'status' => false,
                  'message' => "You can't cancel your booking after 6 hours."
              ]);
          }
    
    
        DB::beginTransaction();
    
            $cancelBookingResponse = $this->bookingService->cancelBooking($booking->id, $request->reason);
    
            if ($cancelBookingResponse['status'] === true) {
                $confirmResult = $this->ECashService->reverseTransaction($booking->invoice_id);
    
                if ($confirmResult) {
                    DB::commit();
                    return response()->json([
                        'status' => true,
                        'message' => 'Refund Successfully'
                    ]);
                } else {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'message' => 'Something went wrong in confirm refund'
                    ]);
                }
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong in cancel booking'
                ]);
            }
        
    }


    public function resellBooking(ResellTicketRequest $request)
    {
        DB::beginTransaction();
        try{
            $booking = Booking::find($request['ticket_id']);
            $event = Event::find($booking->event_id);
            $user =MobileUser::find($request['user_id']) ;
            if ($booking->user_id == Auth::id()) {
                $booking->update([
                    'user_id' => $request['user_id'] ,
                    'first_name' => $user->first_name,
                    'last_name'  => $user->last_name,
                ]);
                try{
                    Notification::create([
                        'title' => 'Ticket Resell ',
                        'description' => 'You have received a resale ticket from ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' for the event [ '. $event->title .' ] on [ '.$event->start_date .' ] '   . $event->id,
                        'user_id' => $request['user_id'] ,
                        'title_ar'=>'إعادة بيع التذكرة' ,
                        'description_ar' => 'لقد تلقيت تذكرة إعادة بيع من ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' للحدث [ '. $event->title .' ] في [ '.$event->start_date .' ] '   .  $event->id
                    ]);
                    $notificationController = new NotificationController();
                    $notificationController->sentNotification($request['user_id'], 'Ticket Resell', 'You have received a resale ticket from ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' for the event [ '. $event->title .' ] on [ '.$event->start_date .' ] '   .  $event->id
                        , 'إعادة بيع التذكرة', 'لقد تلقيت تذكرة إعادة بيع من ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' للحدث [ '. $event->title .' ] في [ '.$event->start_date .' ] '   .  $event->id);
                }catch (\Throwable $exception)
                {}
                DB::commit();
                return response()->json([
                    'status'=> true,
                    'message' => 'Resell Successfully'
                ]);
            }else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'forbidden'
                ]);
            }
        }catch (\Throwable $throwable)
        {
            DB::rollBack();
            return response()->json([
                'status' => false ,
                'message' => 'Error In Resell Ticket'
            ]) ;
        }
    }
    
    public function cancelled_bookings(){
        $cancelled_bookings = CancelledBooking::where('status','pending')->get();
        return view('bookings.index',['cancelled_bookings'=>$cancelled_bookings]);
    }

    public function acceptCancel($id){
        $booking = CancelledBooking::findOrFail($id);
        $book = Booking::findOrFail($booking->booking_id);
        $book->delete();
        //dd($booking);
        try {
            Notification::create([
                'title' => 'Booked Cancelled Successfully',
                'description' => 'Your cancellation request has been accepted. The refund will be processed according to our terms of service. Thank you for your understanding.',
                'user_id' => $booking->user_id ,
                'title_ar' => 'تم الغاء الحجز بنجاح',
                'description_ar' => 'تم قبول طلب الإلغاء الخاص بك. سيتم معالجة استرداد الدفعة وفقًا لشروط الخدمة. شكرًا لتفهمك.'
            ]);
            $notificationController = new NotificationController();
            $notificationController->sentNotification($booking->user_id, 'Booked Cancelled Successfully', 'Your cancellation request has been accepted. The refund will be processed according to our terms of service. Thank you for your understanding.'
                , 'تم الغاء الحجز بنجاح', 'تم قبول طلب الإلغاء الخاص بك. سيتم معالجة استرداد الدفعة وفقًا لشروط الخدمة. شكرًا لتفهمك.');
        } catch (\Throwable $exception) {}
        $booking->update(['status'=>'paid']);
        return redirect()->back()->with('success','Booked Cancelled Successfully');
    }

    public function rejectCancel($id){
        $booking = CancelledBooking::findOrFail($id);
        try {
            Notification::create([
                'title' => 'Booked Cancelled rejected',
                'description' => 'Your cancellation request has been rejected. For further information or assistance, please contact our customer support.',
                'user_id' => $booking->user_id ,
                'title_ar' => 'تم رفض طلب الغاء الحجز',
                'description_ar' => 'لم يتم قبول طلب الإلغاء الخاص بك. لمزيد من المعلومات أو المساعدة، يرجى الاتصال بدعم العملاء.'
            ]);
            $notificationController = new NotificationController();
            $notificationController->sentNotification($booking->user_id, 'Booked Cancelled Rejected', 'Your cancellation request has been rejected. For further information or assistance, please contact our customer support.'
                , 'تم رفض طلب الغاء الحجز', 'لم يتم قبول طلب الإلغاء الخاص بك. لمزيد من المعلومات أو المساعدة، يرجى الاتصال بدعم العملاء.');
        } catch (\Throwable $exception) {}
        $booking->delete();
        return redirect()->back()->with('error','Booked Cancelled Rejected');
    }
}
