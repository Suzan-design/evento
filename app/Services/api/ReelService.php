<?php


namespace App\Services\api;

use App\Models\Action\ReelComment;
use App\Models\Action\ReelLike;
use App\Models\Common\Reel;
use Illuminate\Support\Facades\Auth;

class ReelService
{
    public function getReels()
    {
        $userId = Auth::id();
        $baseUrl = url('/storage/');
    
        return Reel::with(['event' => function ($query) {
            $query->withoutGlobalScopes();
        }, 'venue', 'organizer'])
            ->withCount(['likes', 'comments'])
            ->paginate(4)
            ->through(function ($reel) use ($userId, $baseUrl) {
                $reel->liked_by_user = $reel->likes()->where('user_id', $userId)->exists();
                $reel->videos = $this->stripBaseUrlFromVideos($reel->videos, $baseUrl);
                return $reel;
            });
    }
    
    private function stripBaseUrlFromVideos($videosJson, $baseUrl)
    {
        $videos = json_decode($videosJson, true);
        if (is_array($videos)) {
            $videos = array_map(function ($video) use ($baseUrl) {
                return str_replace($baseUrl . '/', '', $video);
            }, $videos);
        }
        return json_encode($videos, JSON_UNESCAPED_SLASHES);
    }


    public function toggleLike($reelId)
    {
        $userId = Auth::id();
        $like = ReelLike::where('user_id', $userId)->where('reel_id', $reelId)->first();

        if ($like) {
            $like->delete();
            return ['status' => true, 'message' => 'Like deleted successfully'];
        } else {
            ReelLike::create([
                'user_id' => $userId,
                'reel_id' => $reelId
            ]);

            return ['status' => true, 'message' => 'Like added successfully'];
        }
    }

    public function addComment($data, $reelId)
    {
        $comment = ReelComment::create([
            'body' => $data['body'],
            'user_id' => Auth::id(),
            'reel_id' => $reelId
        ]);

        return ['message' => 'Comment added successfully', 'comment' => $comment];
    }
}
