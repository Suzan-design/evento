<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Event\BookingRequest;
use App\Http\Requests\Event\CancelBookingRequest;
use App\Models\Event\Booking;
use App\Services\api\BookingService;


class BookingController extends Controller
{


    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function myBookings()
    {
        $result = $this->bookingService->getMyBookings();

        return response()->json($result);
    }

    public function myCancelledBookings()
    {
        $result = $this->bookingService->getMyCancelledBookings();

        return response()->json($result);
    }
    public function get_ticket($id)
    {
        $booking = Booking::with(['event' => function($query) {
            $query->withoutGlobalScopes();
        } ,'event.amenities'=> function($query) {
                $query->withoutGlobalScopes();
            }, 'event.venue', 'event.organizer', 'promoCode' , 'offer' , 'event.classes'])
            ->find($id);
        if($booking)
            return response()->json([
                'status' => true ,
                'ticket'=> $booking
            ]) ;
        else
            return response()->json([
                'status' => true ,
                'message'=> 'ticket not found'
            ]) ;
    }
}
