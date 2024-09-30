<?php
namespace App\Http\Controllers\web\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventRequest;
use App\Models\Event\Event;
use App\Models\Event\EventCategory;
use App\Models\User\Organizer;
use App\Scopes\ExcludeAttributeScope;
use App\Services\web\EventService;
use App\Models\Common\Amenity;
use App\Models\ServiceProvider\ServiceProvider;
use App\Models\Venue\Venue;
use Illuminate\Http\Request;
use App\Models\Event\Booking;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        // Fetch necessary data for the create view
        $venues = Venue::all();
        $categories = EventCategory::select('id', 'title','icon')->get();
        //dd($categories);
        $amenities = Amenity::select('id', 'title')->get();
        $serviceProviders = ServiceProvider::select('id', 'user_id' , 'name' ,'profile')->where('type' , 'Approved')->get();
        $organizers = Organizer::select('id', 'name' , 'mobile_user_id')->where('type' , 'Approved')->get();
        return view('events.create', compact('venues', 'categories', 'amenities', 'serviceProviders' , 'organizers'));
    }

    public function store(EventRequest $request)
    {
    if ($request->has('amenities')) {
            $filteredAmenities = collect($request->input('amenities'))->filter(function ($value, $key) {
                return is_array($value);
            })->all();

            $request->merge(['amenities' => $filteredAmenities]);
        }

    $filteredServiceProviders = array_unique($request->input('service_providers', []));

    //dd($filteredServiceProviders);
    // Update the request with the filtered data
    $request->merge([
        'service_providers' => $filteredServiceProviders
    ]);

        $request['type'] = $request->has('type') ? 'featured' : 'normal';
        $this->eventService->createEvent($request->all(), $request->file('images'), $request->file('videos'));
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show($eventId)
    {
        $event = Event::withoutGlobalScopes()->findOrFail($eventId);
        return view('events.show', compact('event'));
    }

    public function edit($eventId)
    {
        $event = Event::withoutGlobalScopes()->with('serviceProviders','eventTrips','classes')->findOrFail($eventId);
        $venues = Venue::all();
        $categories = EventCategory::select('id', 'title')->get();
        $amenities = Amenity::select('id', 'title')->get();
        $serviceProviders = ServiceProvider::select('id', 'user_id'  , 'name' , 'profile' )->where('type' , 'Approved')->get();
        //dd($event->classes);
        $organizers = Organizer::select('id', 'name')->where('type' , 'Approved')->get();
//dd($event);
        return view('events.edit', compact('event','venues', 'categories', 'amenities', 'serviceProviders' , 'organizers'));
    }

    public function update(Request $request, $eventId)
{
    // Validation rules
    $rules = [
        'title' => 'required|string|max:255',
        'title_ar' => 'required|string|max:255',
        'category_ids' => 'required|array',
        'category_ids.*' => 'exists:event_categories,id',
        'venue_id' => 'required|exists:venues,id',
        'capacity' => 'required|integer|min:0',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'ticket_price' => 'required|numeric|min:0',
        'description' => 'required|string|max:2000',
        'amenity' => 'nullable|array',
        'classes' => 'required|array',
        'classes.*.code' => 'required_with:classes.*|string|max:255',
        'classes.*.ticket_number' => 'required_with:classes.*|numeric|min:1',
        'classes.*.ticket_price' => 'required_with:classes.*|numeric|min:0',
        'classes.*.amenity_ids' => 'nullable|array',
        'classes.*.amenity_ids.*' => 'exists:amenities,id',
        'service_providers' => 'nullable|array',
        //'service_providers.*' => 'exists:service_providers,id',
        'event_trips' => 'nullable|array',
        'event_trips.*.start_date' => 'date|after_or_equal:today',
        'event_trips.*.end_date' => 'date|after_or_equal:event_trips.*.start_date',
        'event_trips.*.description' => 'nullable|string|max:1000',
        'organizer_id' => 'required|exists:organizers,id',
        'cancellation_time' => 'required|numeric|min:0',
        'new_images' => 'nullable|array',
        'new_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'new_videos' => 'nullable|array',
        'new_videos.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:20480',
    ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Filter out the "new" => null entry from service providers
    $service_providers = array_filter($request->service_providers, function ($value) {
        return !is_null($value) && $value !== '';
    });

    $request->merge(['service_providers' => $service_providers]);

    // Filter and format amenities
    $amenities = array_filter($request->amenity, function ($amenity) {
        return isset($amenity['description']) && isset($amenity['description_ar']) && isset($amenity['price']);
    });
    $request->amenity = $amenities;

    // Find the event without global scopes
    $event = Event::withoutGlobalScopes()->findOrFail($eventId);

    // Update the event
    $this->eventService->updateEvent($event, $request);

    return redirect()->route('events.index')->with('success', 'Event updated successfully.');
}




    public function destroy($eventId)
    {
        $event = Event::withoutGlobalScopes()->findOrFail($eventId);
        $this->eventService->deleteEvent($event);
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
    
    
    public function eventTicket($event_id)
    {
        $bookings = Booking::where('event_id', $event_id)->get();
        $event = Event::withoutGlobalScopes()->find($event_id) ;
        $totalAmenityPrice = 0 ;
        foreach ($bookings as $booking){
            foreach ($booking->amenities as $amenity) {
                $amenityId = $amenity->id ; 
                $amenityPrice = $event->amenities()->wherePivot('amenity_id', $amenityId)->first()->pivot->price ?? null;
                
                $totalAmenityPrice = $amenityPrice + $totalAmenityPrice;
            }
            $booking->amenityPrice = $totalAmenityPrice ;
            $totalAmenityPrice = 0  ;
            if($event->classes()->find($booking->class_id))
            $booking->class_price = $event->classes()->find($booking->class_id)->ticket_price ; 
        }


        return view('events.event_ticket' , compact('bookings')) ;
    }
}
