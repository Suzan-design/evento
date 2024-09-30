<?php


namespace App\Services\api;


use App\Http\Requests\Event\BookingRequest;
use App\Models\Event\Booking;
use App\Models\Invoice;
use App\Models\Event\CancelledBooking;
use App\Models\Event\Event;
use App\Models\Event\EventClass;
use App\Models\User\MobileUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingService
{

    public function book(BookingRequest $request)
{
    DB::beginTransaction();
    try {
        $bookingIds = $this->processBookings($request);
        DB::commit();
        return [
            'status' => true,
            'message' => 'Booking successful',
            'booking_id' => $bookingIds['booking_id'], // Return the booking_id from the array
        ];
    } catch (\Throwable $exception) {
        DB::rollBack();
        return [
            'status' => false,
            'message' => $exception->getMessage()
        ];
    }
}

private function processBookings(BookingRequest $request): array
{
    $user = Auth::user();
    $event = Event::findOrFail($request['event_id']);

    if (isset($request['promo_code_id'])) {
        if (!$user->hasPromoCode($request['promo_code_id'])) {
            throw new \Exception("User does not have the specified promo code");
        }

        if (!$event->allowsPromoCode($request['promo_code_id'])) {
            throw new \Exception("The event does not allow the specified promo code");
        }
    }

    $class = EventClass::findOrFail($request['class_id']);
    $this->checkAndReduceTicketNumber($class);
    $offer = $event->offer;
    $offer_id = null;
    if ($offer) {
        $offer_id = $offer->id;
    }
    $booking = $this->createBooking($request, $class, $user, $offer_id);

    return ['booking_id' => $booking->id]; // Return an array containing the booking_id
}


    private function checkAndReduceTicketNumber(EventClass $class): void
    {
        if ($class->ticket_number === 0) {
            throw new \Exception('Tickets in Class ' . $class->code . ' sold out');
        }

        $class->update(['ticket_number' => $class->ticket_number - 1]);
    }

    private function createBooking(
        BookingRequest $request,
        EventClass $class,
        MobileUser $user,
        $offer_id
    ): Booking {
        return Booking::create([
            'user_id' => $user->id,
            'class_id' => $request['class_id'] ,
            'event_id' => $request->input('event_id'),
            'user_phone_number' => $user->phone_number,
            'event_title' => $class->event->title,
            'class_type' => $class->code,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'age' => $request['age'],
            'phone_number' => $request['phone_number'],
            'amenities' => json_encode($request['options']),
            'class_ticket_price' => $request['class_ticket_price'] ,
            'promo_code_id' => $request['promo_code_id'] ?? null ,
            'offer_id' => $offer_id,
        ]);
    }

    public function getMyBookings(): array
    {
        $user = Auth::user();
    
        // Eager load the necessary relationships, including cancellation_time
        $allBookings = $user->bookings()->with([
            'event' => function($query) {
                $query->withoutGlobalScopes()->select('id', 'start_date', 'cancellation_time', 'organizer_id', 'title', 'capacity', 'end_date', 'ticket_price', 'description', 'type', 'images', 'venue_id');
            },
            'event.venue',
            'event.amenities' => function($query) {
                $query->withoutGlobalScopes();
            }
        ])->get();
    
        // Group the bookings by user_id and event_id
        $groupedBookings = $allBookings->groupBy(['user_id', 'event_id']);
    
        $completedBookings = collect([]);
        $upcomingBookings = collect([]);
        if (!$groupedBookings->isEmpty()) {
            foreach ($groupedBookings->first() as $group) {
                if (isset($group[0]['event']['start_date'])) {
                    if (Carbon::parse($group[0]['event']['start_date'])->isPast()) {
                        $completedBookings->push($group);
                    } else {
                        $upcomingBookings->push($group);
                    }
                }
            }
        }
    
        // Return the bookings, including cancellation_time within upcomingBookings
        return [
            'status' => true,
            'completedBookings' => $completedBookings,
            'upcomingBookings' => $upcomingBookings->map(function ($booking) {
                $booking->each(function ($item) {
                    $item['event']['cancellation_time'] = $item['event']['cancellation_time'];
                });
                return $booking;
            }),
        ];
    }


    public function cancelBooking($bookingId, $reason): array
    {
        DB::beginTransaction();

            $booking = Booking::findOrFail($bookingId);
            //dd($booking);
            if($booking['user_id'] != Auth::id()){
            //dd($booking['user_id']);
                return [
                    'status' => false ,
                    'message' => 'forbidden'
                ];
            }
            $invoice = Invoice::where('external_id', $booking->invoice_id)->first();
            
            $amount = $invoice ? $invoice->amount : 0;
            //dd($amount);
            $class = EventClass::find($booking->class_id);
            //dd($booking);
            $class->increment('ticket_number');
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
                'reason' => $reason,
                'status' =>'paid',
            ];

            if ($booking->promo_code_id !== null) {
                $cancelledBookingData['promo_code_id'] = $booking->promo_code_id;
            }

            $cancelledBooking = CancelledBooking::create($cancelledBookingData);

            $booking->delete();

            DB::commit();

            return [
                'status' => true,
                'message' => 'Booking cancelled successfully',
                'cancelled_booking' => $cancelledBooking,
            ];
        
    }

    public function getMyCancelledBookings(): array
    {
        $user = Auth::user();

        $cancelledBookings = $user->cancelledBookings()->with(['event' => function($query) {
            $query->withoutGlobalScopes();
        }, 'event.venue' ,
            'event.amenities'=> function($query) {
                $query->withoutGlobalScopes();
            }])->get();

        return [
            'status' => true,
            'cancelled_bookings' => $cancelledBookings,
        ];
    }

}
