<?php

namespace App\Http\Controllers;
use App\Models\Action\Review;
use App\Models\Common\Amenity;
use App\Models\Common\Reel;
use App\Models\Event\EventRequest;
use App\Models\Event\Offer;
use App\Models\PromoCode\PromoCode;
use App\Models\PublicNotification;
use App\Models\ServiceProvider\ServiceCategory;
use App\Models\Venue\Venue;
use Illuminate\Support\Carbon;
use App\Scopes\ExcludeAttributeScope;
use App\Models\ServiceProvider\ServiceProvider;
use App\Models\User\Organizer;
use App\Models\Event\Booking;
use App\Models\Event\CancelledBooking;
use App\Models\Event\Event;
use App\Services\web\EventsRequestCategoryService;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $eventsCategoryService;
    public function __construct(EventsRequestCategoryService $eventsCategoryService)
    {
        $this->eventsCategoryService = $eventsCategoryService;
    }
    public function index(){
        $user_count = \App\Models\User\MobileUser::count() ;

        $event_count = Event::withoutGlobalScope(\App\Scopes\UpcomingEventScope::class)->count() ;

        $booking_count = Booking::count();

        $organizer_count = Organizer::count() ;

        $serviceProvider_count = ServiceProvider::count() ;

        $TotalEventCategories=\App\Models\Event\EventCategory::count();

        $ServiceCategories_count=   ServiceCategory::count();
        // $CustomEventCategories
        $Amenities=Amenity::count();

        $Venues=Venue::count();

        $today_users_count = \App\Models\User\MobileUser::whereDate('created_at', Carbon::today())->count();

        $todaysEventsCount = Event::whereDate('created_at', Carbon::today())->count();

        $EventRequests = EventRequest::count();

        $ServiceProviderRequests = ServiceProvider::withoutGlobalScope(ExcludeAttributeScope::class)->with(['user'  , 'category'])->where('type' , 'pending')->count() ;

        $OrganizerRequests = Organizer::withoutGlobalScope(ExcludeAttributeScope::class)
        ->with(['mobileUser' , 'categories'])
        ->where('type', 'pending')->count();

        // Calculate total capacity of all events
        $totalTicketsNumber = Event::sum('capacity');

        // Calculate total booked tickets where status is paid
        $totalBookedTickets = Booking::where('status', 'paid')->count();

        // Calculate total cancelled tickets
        $totalCancelledTickets = CancelledBooking::count();

        // Calculate total ticket price for all booked tickets
        $totalBookedTicketsPrice = Booking::where('status', 'paid')
        ->join('invoices', 'bookings.invoice_id', '=', 'invoices.external_id')
        ->sum('invoices.amount');

        // Retrieve all cancelled bookings
        $totalCancelledTicketsPrice = CancelledBooking::sum('amount');

        $PromoCodes=PromoCode::count();

        $Offers=Offer::count();

        $Reviews = Review::count();

        $events_request_categories = $this->eventsCategoryService->getAllEventCategories()->count();


        $Notifications = PublicNotification::count();

        $reels = Reel::count();

        return view('Dashboard', compact(
            'user_count',
            'event_count',
            'booking_count',
            'organizer_count',
            'serviceProvider_count',
            'TotalEventCategories',
            'ServiceCategories_count',
            'Amenities',
            'Venues',
            'today_users_count',
            'todaysEventsCount',
            'EventRequests',
            'ServiceProviderRequests',
            'OrganizerRequests',
            'totalTicketsNumber',
            'totalBookedTickets',
            'totalCancelledTickets',
            'totalBookedTicketsPrice',
            'totalCancelledTicketsPrice',
            'PromoCodes',
            'Offers',
            'Reviews',
            'events_request_categories',
            'Notifications',
            'reels'
        ));

}
}