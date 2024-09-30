<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Action\ReelCommentRequest;
use App\Models\Common\Reel;
use App\Services\api\ReelService;
use Illuminate\Support\Facades\Auth;


class ReelController extends Controller
{
    private $reelService;

    public function __construct(ReelService $reelService)
    {
        $this->reelService = $reelService;
    }

    public function show($id)
    {
        $userId = Auth::id();

        // Fetch the specific reel as before
        $reel = Reel::with(['event' => function ($query) {
            $query->withoutGlobalScopes();
        }, 'venue', 'organizer'])
            ->withCount(['likes', 'comments'])
            ->find($id);

        if ($reel) {
            $reel->liked_by_user = $reel->likes()->where('user_id', $userId)->exists();
        }

        // Fetch additional reels with pagination. You can adjust the pagination size as needed.
        $otherReels = Reel::where('id', '!=', $id)
            ->with(['event' => function ($query) {
                $query->withoutGlobalScopes();
            }, 'venue', 'organizer'])
            ->withCount(['likes', 'comments'])
            ->paginate(4); // You can adjust the number of items per page.

        return response()->json([
            'status' => true,
            'requestedReel' => $reel,
            'otherReels' => $otherReels
        ]);
    }

    public function index()
    {
        $reels = $this->reelService->getReels();

        return response()->json([
            'status' => true,
            'reels' => $reels
        ]);
    }

    public function addLike($reelId)
    {
        $result = $this->reelService->toggleLike($reelId);

        return response()->json($result);
    }

    public function addComment(ReelCommentRequest $request, $reelId)
    {
        $result = $this->reelService->addComment($request, $reelId);

        return response()->json($result);
    }
}
