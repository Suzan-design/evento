<?php

namespace App\Http\Controllers\api;

use App\Events\NotificationEvent;
use App\Http\Controllers\api\Action\NotificationController;
use App\Http\Requests\Event\EventSearchRequest;
use App\Models\Action\Notification;
use App\Models\Event\Event;
use App\Models\User\MobileUser;
use App\Services\api\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    protected $eventService ;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService ;
    }


    public function show($id)
    {
        return $this->eventService->event_details($id) ;
    }

    public function showGoing($id)
    {
        $event = Event::find($id) ;

        $uniqueUserIds = $event->bookings()
            ->select('user_id')
            ->distinct()
            ->pluck('user_id');

        $uniqueUsers = MobileUser::whereIn('id', $uniqueUserIds)
            ->select('id', 'first_name', 'last_name', 'type' , 'image')
            ->paginate(10);

        return response()->json([
           'status' =>  true  ,
           'Goings' =>  $uniqueUsers
        ]);
    }

    public function showNearestEvents(Request $request)
    {
        return response()->json([
            'status'=> true ,
            'events' => $this->eventService->NearestEvents($request->all())
        ]);
    }

    public function filter(Request $request)
    {
        // Start with a query builder, not a collection
        $query = Event::with('venue');

        // Apply the 'nearest' condition
        if ($request['distance']) {
            $query = $query->nearest($request['latitude'], $request['longitude'], $request['distance']);
        }

        // Apply the category filter
        if ($request['event_category'] != null) {
            $eventsCategory = $request['event_category'];
            $query = $query->whereHas('categories', function ($subQuery) use ($eventsCategory) {
                $subQuery->whereIn('event_category_id', $eventsCategory);
            });
        }

        // Apply the state filter
        if ($request['state'] != null) {
            $state = $request['state'];
            $query = $query->whereHas('venue', function ($subQuery) use ($state) {
                $subQuery->where('governorate', $state);
            });
        }

        // Apply the minimum ticket price filter
        if ($request['min_ticket_price'] != null) {
            $query = $query->where('ticket_price', '>=', $request['min_ticket_price']);
        }

        // Apply the maximum ticket price filter
        if ($request['max_ticket_price'] != null) {
            $query = $query->where('ticket_price', '<', $request['max_ticket_price']);
        }

        // Get the final list of events after all conditions have been applied
        $events = $query->get();

        return response()->json([
            'status' => true,
            'events' => $events
        ]);
    }


    public function favorite_filter(Request $request)
    {
        $events= Event::with('venue') ;
        $userId = auth()->id();

        $events = $events->whereHas('followers', function ($query) use ($userId) {
            $query->where('mobile_user_id', $userId);
        });

        if ($request['event_category'] != null) {

            $eventsCategory = $request['event_category'] ;
            $events = $events->whereHas('categories', function ($query) use ($eventsCategory) {
                $query->whereIn('event_category_id', $eventsCategory);
            });
        }

        if ($request['state'] != null) {
            $state = $request['state'] ;
            $events = $events->whereHas('venue', function ($query) use ($state) {
                $query->where('governorate', $state);
            });
        }

        if ($request['min_ticket_price'] != null){
            $events = $events->where('ticket_price' , '>=' , $request['min_ticket_price']);
        }

        if ($request['max_ticket_price'] != null){
            $events = $events->where('ticket_price' , '<' , $request['max_ticket_price']);
        }

        return response()->json([
            'status' => true ,
            'events' => $events->get()
        ]);

    }
    public function search(EventSearchRequest $request)
    {
        // Start the query builder with conditions
        $query = Event::with('venue')
            ->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . $request['Search'] . '%')
                    ->orWhere('title_ar', 'like', '%' . $request['Search'] . '%')
                    ->orWhere('description', 'like', '%' . $request['Search'] . '%')
                    ->orWhere('description_ar', 'like', '%' . $request['Search'] . '%');
            })
           ;

        // Conditionally apply limit if the search query is empty
        $query->when(empty($request['Search']), function ($q) {
            return Event::with('venue');
        });

        // Execute the query
        $result = $query->get();

        // Return the response
        return response()->json([
            'status' => true,
            'result' => $result
        ]);
    }

    public function invite(Request $request)
    {
        try{
            Notification::create([
                'title' => 'You have a new event Invitation ',
                'description' => Auth::user()->first_name . ' ' . Auth::user()->last_name . ' Invite you to event ' . $request['event_name'] . ' ' . $request['event_id'],
                'user_id' => $request['user_id'] ,
                'title_ar' => 'لديك دعوة حدث جديدة' ,
                'description_ar' =>'You have a new event Invitation', Auth::user()->first_name . ' ' . Auth::user()->last_name . ' Invite you to event ' . $request['event_name'] . ' ' . $request['event_id'],
            ]);
            $notificationController = new NotificationController();
            $notificationController->sentNotification($request['user_id'], 'You have a new event Invitation', Auth::user()->first_name . ' ' . Auth::user()->last_name . ' Invite you to event ' . $request['event_name'] . ' ' . $request['event_id'], 'لديك دعوة حدث جديدة', Auth::user()->first_name . ' ' . Auth::user()->last_name . ' يدعوك للحدث ' . $request['event_name'] . ' ' . $request['event_id']);;
        }catch (\Throwable $exception)
        {}

        return response()->json([
            'status' => true ,
            'message' => 'Invited Successfully'
        ]) ;
    }
}
