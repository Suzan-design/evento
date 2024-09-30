<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicNotificationRequest;
use App\Models\Action\Notification;
use App\Models\Event\Event;
use App\Models\Event\EventCategory;
use App\Models\PublicNotification;
use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use App\Models\Venue\Venue;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $public_notifications = PublicNotification::all() ;
        return view('notification.index' , compact('public_notifications'));
    }

    public function dashboard()
    {
        $events = Event::select('id','title')->get() ;
        $venues = Venue::select('id','name')->get() ;
        $organizers = Organizer::select('id','name')->get() ;

        $categories = EventCategory::all() ;
        return view('notification.create' , compact('categories' , 'events','venues' , 'organizers'));
    }

    public function sentNotification(PublicNotificationRequest $request)
    {
        $notification = new PublicNotification();
        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->title_ar = $request->title_ar;
        $notification->description_ar = $request->description_ar;

        // Handle nullable fields
        $notification->target_states = $request->has('user_city') ? implode(',', $request->user_city) : null;
        $notification->target_categories = $request->has('user_interest_ids') ? implode(',', $request->user_interest_ids) : null;
        $notification->target_ages = $request->has('ageRangeStart') && $request->has('ageRangeEnd') ? $request->ageRangeStart . '-' . $request->ageRangeEnd : null;
        $notification->target_bookings = $request->has('bookingRangeStart') && $request->has('bookingRangeEnd') ? $request->bookingRangeStart . '-' . $request->bookingRangeEnd : null;

        $notification->save(); // Save the notification to the database

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

        $navigateString = '' ;

        if ($request['type'] == 'organizer') {
            $navigateString = 'organizer '.$request['organizer_id'];
        }elseif($request['type'] == 'venue') {
            $navigateString = 'venue '.$request['venue_id'];
        }elseif ($request['type'] == 'event') {
            $navigateString = 'event '.$request['event_id'];
        }

        foreach ($mobileUserIds as $mobileUserId) {
            try{
                Notification::create([
                    'title' => $request['title'].' navigate '.$navigateString,
                    'description' => $request['description'],
                    'title_ar' => $request['title_ar'].' navigate '.$navigateString,
                    'description_ar' => $request['description_ar'],
                    'user_id' => $mobileUserId
                ]);
                $notificationController = new \App\Http\Controllers\api\Action\NotificationController();
                $notificationController->sentNotification($mobileUserId, $request['title'] , $request['description'], $request['title_ar'], $request['description_ar'] ,$navigateString);
            }catch (\Throwable $e){}
        }
        return redirect()->route('notification.index');
    }

    protected function getUsersCountNotification(Request $request)
    {
         $usersCount = MobileUser::query()
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
        return response()->json([
            'user_count' => $usersCount,
        ]) ;
    }




}
