<?php
namespace App\Http\Controllers\api\Action;

use App\Http\Controllers\Controller;
use App\Services\api\EventFollowService;
use Illuminate\Support\Facades\Auth;

class EventFollowController extends Controller
{
    private $eventService;

    public function __construct(EventFollowService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function store($id)
    {
        $userId = Auth::guard('mobile')->id();

        if ($this->eventService->attachEventFollowToUser($userId, $id)) {
            return response()->json([
                'status'  => true,
                'message' => 'followed successfully',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Event not found',
            ]);
        }
    }

    public function destroy($id)
    {
        $userId = Auth::guard('mobile')->id();
        $this->eventService->detachEventFollowFromUser($userId, $id);

        return response()->json([
            'status'  => true,
            'message' => 'removed successfully',
        ]);
    }

    public function following_event()
    {
        $userId = Auth::guard('mobile')->id();

        $follow = auth('mobile')->user()->followingEvent()->with('venue')->get();

        return response()->json([
            'status' => true,
            'events' => $follow,
        ]);
    }
}
