<?php


namespace App\Services\api;


use App\Models\Event\Event;

class EventFollowService
{
    public function attachEventFollowToUser($userId, $eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return false; // Event not found
        }

        auth('mobile')->user()->followingEvent()->syncWithoutDetaching([$eventId]);

        return true; // Event attached successfully
    }

    public function detachEventFollowFromUser($userId, $eventId)
    {
        auth('mobile')->user()->followingEvent()->detach($eventId);
    }
}
