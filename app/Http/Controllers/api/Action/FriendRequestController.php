<?php

namespace App\Http\Controllers\api\Action;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Action\FriendRequest;
use App\Models\Action\Notification;
use App\Models\User\MobileUser;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    public function store($receiverId)
    {
        $senderId = Auth::guard('mobile')->id();
        $receiver = MobileUser::find($receiverId) ;
        if (! $receiver)
            return response()->json([
                'status' => true ,
                'message' => 'User not found'
            ]);

        FriendRequest::firstOrCreate([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending'
        ]);

        try {
            $senderName = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            Notification::create([
                'title' => 'New Friend Request',
                'description' => "$senderName sent you a friend request",
                'title_ar' =>'طلب صداقة جديد' ,
                'description_ar'=> "$senderName أرسل لك طلب صداقة" ,
                'user_id' => $receiverId
            ]);

            $notificationController = new NotificationController() ;
            $notificationController->sentNotification($receiverId, 'New Friend Request', "$senderName sent you a friend request",
                'طلب صداقة جديد', "$senderName أرسل لك طلب صداقة");

        }catch (\Throwable $exception) {}

        return response()->json([
            'status' => true,
            'message' => 'Request sent successfully'
        ]);
    }

    public function deny($senderId)
    {
        $friendRequest = FriendRequest::where('receiver_id', Auth::guard('mobile')->id())
            ->where('sender_id', $senderId)
            ->first();

        if ($friendRequest) {
            $friendRequest->delete();

            return response()->json([
                'status' => true,
                'message' => 'Friend request removed successfully'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Friend request does not exist'
        ]);
    }

    public function destroy($friendId)
    {
        $userId = Auth::id();

        $friendRequest = FriendRequest::where(function ($query) use ($userId, $friendId) {
            $query->where('sender_id', $friendId)
                ->orWhere('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $friendId);
        })->first();

        if ($friendRequest) {
            $friendRequest->delete();

            return response()->json([
                'status' => true,
                'message' => 'Friend request removed successfully'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Friend request does not exist'
        ]);
    }

    public function approve($senderId)
    {
        $friendRequest = FriendRequest::where('receiver_id', Auth::guard('mobile')->id())
            ->where('sender_id', $senderId)
            ->first();

        if ($friendRequest) {
            if ($friendRequest->receiver_id == Auth::id()) {
                $friendRequest->update([
                    'status' => 'approve'
                ]);

                try {
                    $senderName = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                    Notification::create([
                        'title' => 'New Friend',
                        'description' => "$senderName has accepted your friend request",
                        'title_ar' => 'صديق جديد',
                        'description_ar' => "$senderName قبل طلب صداقتك" ,
                        'user_id' => $senderId
                    ]);

                    $notificationController = new NotificationController() ;
                    $notificationController->sentNotification($senderId, 'New Friend', "$senderName has accepted your friend request"
                        , 'صديق جديد', "$senderName قبل طلب صداقتك");
                }catch (\Throwable $exception){}

                return response()->json([
                    'status' => true,
                    'message' => 'Friend request approved'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Friend request denied'
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Friend request does not exist'
        ]);
    }

    public function myFriend()
    {
        $userId = Auth::id();

        $friendRequests = FriendRequest::with(['sender:id,first_name,last_name,image,phone_number,birth_date', 'receiver:id,first_name,last_name,image,phone_number,birth_date'])
            ->where('status', 'approve')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })->get();

        $friends = $friendRequests->map(function ($friendRequest) use ($userId) {
            return $friendRequest->sender_id == $userId ? $friendRequest->receiver : $friendRequest->sender;
        });

        return response()->json([
            'status' => true,
            'friends' => $friends
        ]);
    }

    public function mySentRequest()
    {
        $sentFriendRequest = FriendRequest::with(['receiver:id,first_name,last_name,image'])
            ->where('sender_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return response()->json([
            'status' => true,
            'sentRequest' => $sentFriendRequest
        ]);
    }

    public function myReceiveRequest()
    {
        $myReceiveRequest = FriendRequest::with('sender:id,first_name,last_name,image')
            ->where('receiver_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return response()->json([
            'status' => true,
            'receiveRequest' => $myReceiveRequest
        ]);
    }
}
