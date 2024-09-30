<?php

namespace App\Services\api;

use App\Models\Event\Event;
use App\Models\Event\Booking;
use App\Models\Event\EventCategory;
use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventService
{


    public function NearestEvents($data)
    {
        return Event::nearest($data['latitude'], $data['longitude'], $data['distance'])->get();
    }

    public function getOfferEvents()
    {
        return Event::with([
            'venue' => function($query) {
                $query->select('id', 'governorate', 'latitude', 'longitude');
            },
            'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }
        ])
        ->whereHas('offer', function($query) {
            $query->where('status', 'active'); // Ensure only events with an active offer are returned
        })
        ->select('id', 'title', 'title_ar', 'start_date', 'ticket_price', 'videos', 'images', 'venue_id', 'capacity')
        ->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
        }])
        ->paginate(4);
    }


    public function getEventCategories()
    {
        return EventCategory::select('id', 'icon', 'title', 'title_ar')->get();
    }

    public function getTopOrganizers()
    {
        return Organizer::withCount('followers')
            ->orderByDesc('followers_count')
            ->paginate(4);
    }

    public function event_details($id)
    {
        $event = Event::with([
            'eventTrips:id,event_id,start_date,end_date,description',
            'venue:id,governorate,latitude,longitude,name',
            'organizer',
            'categories',
            'amenities',
            'serviceProviders',
            'classes' => function($query) {
                $query->with('amenities');
            } , 
            'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }
        ])->find($id);
        $booked_tickets = Booking::where('event_id',$id)->count();
        if ($event) {
            // Assuming $event is the current event instance
            $relatedEvents = Event::where('id', '!=', $event->id)
                ->whereHas('categories', function ($query) use ($event) {
                    $query->whereIn('event_category_id', $event->categories->pluck('id'));
                })
                ->take(5)
                ->get();

            // Extracting unique users from bookings
            $uniqueUsers = $event->bookings()
                ->with(['user' => function ($query) {
                    $query->select('id', 'first_name', 'last_name' , 'type');
                }])
                ->get()
                ->pluck('user')
                ->unique('id')
                ->values();

            $event->bookings = $uniqueUsers;

            return response()->json([
                'status'  => true,
                'event' => $event ,
                'relatedEvents' => $relatedEvents,
                'booked_tickets' => $booked_tickets
            ]);
        }

        return response()->json([
            'status' => false,
            'message'=> 'Not Found'
        ], 404);
    }

    public function getFeaturedEvents()
    {
        return Event::with(['venue' => function($query) {
            $query->select('id', 'governorate', 'latitude', 'longitude');
        }, 
        'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }])
        ->where('type', 'featured')
        ->select('events.id', 'title', 'title_ar', 'start_date', 'ticket_price', 'videos', 'images', 'venue_id', 'capacity')
        ->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
        }])
        ->paginate(4);
    }

    public function getTrendingEvents()
    {
        return Event::with(['venue' => function($query) {
            $query->select('id', 'governorate', 'latitude', 'longitude');
        } , 
        'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }])->select('id', 'title','title_ar', 'start_date', 'ticket_price', 'videos',
            'images' ,  'venue_id', 'capacity')
            ->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
        }])
            ->orderBy('paid_bookings_count', 'desc')
            ->paginate(4);
    }

    public function getOrganizerEvent()
    {
        $user = Auth::user();

        // Assuming 'followingOrganizer' is a relationship in your User model
        $followedOrganizers = $user->followingOrganizer;


        return Event::with(['venue' => function ($query) {
            $query->select('id', 'governorate', 'latitude', 'longitude');
        } ,
        'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }])
            ->whereIn('organizer_id', $followedOrganizers->pluck('id'))
            ->select('id', 'title', 'title_ar', 'start_date', 'ticket_price', 'videos', 'images', 'venue_id','capacity')
            ->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
        }])
            ->paginate(4);
    }

    public function getEventsInUserCity()
    {
        $userState = Auth::guard('mobile')->user()->state;

        return Event::with(['venue' => function($query) use ($userState) {
            $query->where('governorate', $userState)
                ->select('id', 'governorate', 'latitude', 'longitude');
        }, 
        'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }])->whereHas('venue', function ($query) use ($userState) {
            $query->where('governorate', $userState);
        })->select('id' ,'title', 'title_ar','start_date', 'ticket_price', 'videos', 'capacity',
            'images' , 'venue_id')
        ->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
        }])->paginate(4);
    }

    public function getJustForYouEvents()
    {
        $authenticatedUser = Auth::guard('mobile')->user();

        if ($authenticatedUser) {
            // Retrieve the event_category_ids associated with the authenticated user
            $userInterest = $authenticatedUser->eventCategories ;

            // Use the retrieved event_category_ids in your existing code
            $events = Event::with(['venue' => function($query) {
                $query->select('id', 'governorate', 'latitude', 'longitude');
            }, 
            'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }])->whereHas('categories', function ($query) use ($userInterest) {
                $query->whereIn('event_category_id', $userInterest->pluck('id'));
            })->select('id' ,'title', 'title_ar', 'start_date', 'ticket_price', 'videos','capacity',
                'images' , 'venue_id')
            ->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
        }])->paginate(4);
            return $events;
        }
    }

    public function getTonightEvents()
    {
        $startTime = Carbon::today()->setHour(18);
        $endTime = Carbon::today()->endOfDay();

        return Event::with(['venue' => function($query) {
            $query->select('id', 'governorate', 'latitude', 'longitude');
        }, 
        'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }])->where('start_date', '>=', $startTime)
            ->where('start_date', '<=', $endTime)
            ->select('id' ,'title','title_ar', 'start_date', 'ticket_price' , 'videos','capacity',
                'images' , 'venue_id')
            ->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
        }])->paginate(4);
    }

    public function getThisWeekEvents()
    {
        $today = Carbon::today();
        $sevenDaysLater = Carbon::today()->addDays(7);

        return Event::with(['venue' => function($query) {
            $query->select('id', 'governorate', 'latitude', 'longitude');
        }, 
        'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }])->where('start_date', '>=', $today)
            ->where('start_date', '<=', $sevenDaysLater)
            ->select('id' ,'title','title_ar', 'start_date', 'ticket_price' , 'videos','capacity',
                'images' , 'venue_id' )
            ->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
            }])->paginate(4);
    }

    public function getEventAccordingCategory($id)
    {
        return Event::with(['venue' => function($query) {
            $query->select('id', 'governorate', 'latitude', 'longitude');
        }, 
        'offer' => function($query) {
                $query->where('status', 'active'); // Add condition to load only active offers
            }])->whereHas('categories', function ($query) use ($id) {
            $query->where('event_category_id', $id); // Specify the table alias or the full column name
        })->select('events.id', 'title', 'title_ar', 'start_date', 'ticket_price', 'videos', 'images', 'venue_id','capacity')->withCount(['bookings as paid_bookings_count' => function($query) {
            $query->where('status', 'paid');
            }])->paginate(4);
    }

    public function showGoing($id)
    {
        $event = Event::find($id);

        $uniqueUserIds = $event->bookings()
            ->select('user_id')
            ->distinct()
            ->pluck('user_id');

        return MobileUser::whereIn('id', $uniqueUserIds)
            ->select('id', 'first_name', 'last_name', 'type', 'image')
            ->paginate(10);
    }
    public function filterEvents($request)
    {
        $events = Event::query();


        if ($request['event_category'] != null) {
            $eventsCategory = $request['event_category'] ;
            $events = $events->whereHas('categoriesEvents', function ($query) use ($eventsCategory) {
                $query->whereIn('title', $eventsCategory);
            });
        }

        if ($request['state'] != null) {
            $state = $request['state'] ;
            $events = $events->whereHas('venue', function ($query) use ($state) {
                $query->where('governorate', $state);
            });
        }

        if ($request['min_ticket_price'] != null){
            $events = $events->where('ticket_price' , '>' , $request['min_ticket_price']);
        }

        if ($request['max_ticket_price'] != null){
            $events = $events->where('ticket_price' , '<' , $request['max_ticket_price']);
        }
        if($request['distance']){
            $events = $events->nearest($request['latitude'], $request['longitude'], $request['distance']) ;
        }

        return $events->get();
    }


}
