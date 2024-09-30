<?php

namespace App\Http\Controllers\web\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\PromoCodeRequest;
use App\Models\Event\Event;
use App\Models\Event\EventCategory;
use App\Models\PromoCode\PromoCode;
use App\Models\User\MobileUser;
use App\Traits\FileStorageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\web\EventService;


class PromoCodeController extends Controller
{
    use FileStorageTrait;
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $promo_codes = PromoCode::all() ;
        return view('promo_code.index', compact('promo_codes'));
    }


    public function create()
    {
        $categories = EventCategory::all() ;
        $events = $this->eventService->getAllEvents();
        return view('promo_code.create' , compact('categories','events'));
    }


    public function store(PromoCodeRequest $request)
    {
        DB::beginTransaction();
        try{
            $path = $this->storefile($request->file('image'), 'PromoCodeImages');

            $promo_code = PromoCode::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'image' => $path,
                'code' => $request['code'],
                'discount' => $request['discount'],
                'limit' => $request['limit'],
                'start-date' => $request['start-date'],
                'end-date' => $request['end-date'],
                'target_states' => $request->has('user_city') ? implode(',', $request->user_city) : null ,
                'target_categories' => $request->has('user_interest_ids') ? implode(',', $request->user_interest_ids) : null ,
                'target_ages' => $request->has('ageRangeStart') && $request->has('ageRangeEnd') ? $request->ageRangeStart . '-' . $request->ageRangeEnd : null ,
                'target_bookings' =>  $request->has('bookingRangeStart') && $request->has('bookingRangeEnd') ? $request->bookingRangeStart . '-' . $request->bookingRangeEnd : null
            ]);


            $events = Event::query();

            $events->when(isset($request['events_id']), function ($query) use ($request) {
                return $query->whereIn('id', $request['events_id']);
            }, function ($query) use ($request) {
                // If 'events_id' is not set or null, apply other conditions
                $query->when(isset($request['event_category_ids']) && !empty($request['event_category_ids']), function ($q) use ($request) {
                    $q->whereHas('categories', function ($q) use ($request) {
                        $q->whereIn('event_category_id', $request['event_category_ids']);
                    });
                });
                $query->when(isset($request['event_city']) && !empty($request['event_city']), function ($q) use ($request) {
                    $q->whereHas('venue', function ($q) use ($request) {
                        $q->whereIn('governorate', $request['event_city']);
                    });
                });
            });

            $events->when(isset($request['event_limit']), function ($query) use ($request) {
                return $query->take($request['event_limit']);
            });

            $eventIds = $events->pluck('id');

            $mobileUserIds = MobileUser::query()
                ->when(isset($request->user_interest_ids) && !empty($request->user_interest_ids), function ($query) use ($request) {
                    $query->whereHas('eventCategories', function ($q) use ($request) {
                        $q->whereIn('events_category_id', $request->user_interest_ids);
                    });
                })
                ->when(isset($request->ageRangeStart), function ($query) use ($request) {
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= ?', [$request->ageRangeStart]);
                })
                ->when(isset($request->ageRangeEnd), function ($query) use ($request) {
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) <= ?', [$request->ageRangeEnd]);
                })
                ->withCount(['bookings'])
                ->when(isset($request->bookingRangeStart) && isset($request->bookingRangeEnd), function ($query) use ($request) {
                    $query->havingRaw('bookings_count >= ? AND bookings_count <= ?', [$request->bookingRangeStart, $request->bookingRangeEnd]);
                })
                ->when(isset($request->user_city) && !empty($request->user_city), function ($query) use ($request) {
                    $query->whereIn('state', $request->user_city);
                })
                ->when(isset($request['user_limit']), function ($query) use ($request) {
                    return $query->take($request['user_limit']);
                })
                ->pluck('id');

            $promo_code->events()->attach($eventIds);
            $promo_code->users()->attach($mobileUserIds);
            DB::commit();
            return redirect()->route('promo_code.index')->with('success', 'Promo Code created successfully.');
        }catch (\Throwable $ex){
            DB::rollBack();
            return response()->json([
                'status' => true,
                'Exception' => $ex->getMessage()
            ]) ;
        }
    }


    public function show(PromoCode $promo_code)
    {
        return view('promo_code.show', compact('promo_code'));
    }


    public function edit(PromoCode $promo_code)
    {
        return view('promo_code.edit', compact('promo_code'));
    }


    public function update(Request $request, PromoCode $promo_code)
    {
        return redirect()->route('promo_code.index')->with('success', 'Promo Code updated successfully.');
    }


    public function destroy(PromoCode $promo_code)
    {
        $promo_code->delete();
        return redirect()->route('promo_code.index')->with('success', 'Promo Code deleted successfully.');
    }

    public function count(Request $request)
    {

        $usersCount = $this->getUsersCount($request);
        $eventsCount = $this->getEventsCount($request);

        return response()->json([
            'user_count' => $usersCount,
            'eventsCount' => $eventsCount
        ]) ;
    }


    protected function getUsersCount(Request $request)
    {
        return MobileUser::query()
            ->when(isset($request->user_interest_ids) && !empty($request->user_interest_ids), function ($query) use ($request) {
                $query->whereHas('eventCategories', function ($q) use ($request) {
                    $q->whereIn('events_category_id', $request->user_interest_ids);
                });
            })
            ->when(isset($request->ageRangeStart), function ($query) use ($request) {
                $query->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= ?', [$request->ageRangeStart]);
            })
            ->when(isset($request->ageRangeEnd), function ($query) use ($request) {
                $query->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) <= ?', [$request->ageRangeEnd]);
            })
            ->withCount(['bookings'])
            ->when(isset($request->bookingRangeStart) && isset($request->bookingRangeEnd), function ($query) use ($request) {
                $query->havingRaw('bookings_count >= ? AND bookings_count <= ?', [$request->bookingRangeStart, $request->bookingRangeEnd]);
            })
            ->when(isset($request->user_city) && !empty($request->user_city), function ($query) use ($request) {
                $query->whereIn('state', $request->user_city);
            })
            ->when(isset($request['user_limit']), function ($query) use ($request) {
                return $query->take($request['user_limit']);
            })
            ->count() ;
    }

    protected function getEventsCount(Request $request)
    {
        $events = Event::query();

        $events->when(isset($request['events_id']), function ($query) use ($request) {
            return $query->whereIn('id', $request['events_id']);
        }, function ($query) use ($request) {
            // If 'events_id' is not set or null, apply other conditions
            $query->when(isset($request['event_category_ids']) && !empty($request['event_category_ids']), function ($q) use ($request) {
                $q->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('event_category_id', $request['event_category_ids']);
                });
            });
            $query->when(isset($request['event_city']) && !empty($request['event_city']), function ($q) use ($request) {
                $q->whereHas('venue', function ($q) use ($request) {
                    $q->whereIn('governorate', $request['event_city']);
                });
            });
        });

        // Apply limit if provided
        $events->when(isset($request['event_limit']), function ($query) use ($request) {
            return $query->take($request['event_limit']);
        });

        return $events->count();
    }
   
   
}
