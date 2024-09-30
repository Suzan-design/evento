<?php

namespace App\Http\Controllers\api\Action;

use App\Http\Controllers\api\Controller;
use App\Services\api\OrganizerFollowService;
use Illuminate\Support\Facades\Auth;

class OrganizerFollowController extends Controller
{
    private $organizerService;

    public function __construct(OrganizerFollowService  $organizerService)
    {
        $this->organizerService = $organizerService;
    }

    public function store($id)
    {
        $userId = Auth::guard('mobile')->id();

        if ($this->organizerService->attachFollowOrganizerToUser($userId, $id)) {
            return response()->json([
                'status'  => true,
                'message' => 'followed successfully',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Organizer not found',
            ]);
        }
    }

    public function destroy($id)
    {
        $userId = Auth::guard('mobile')->id();
        $this->organizerService->detachFollowOrganizerFromUser($userId, $id);

        return response()->json([
            'status'  => true,
            'message' => 'removed successfully',
        ]);
    }
}
