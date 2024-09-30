<?php


namespace App\Services\api;


use App\Models\User\Organizer;

class OrganizerFollowService
{

    public function attachFollowOrganizerToUser($userId, $organizerId)
    {
        $organizer = Organizer::find($organizerId);

        if (!$organizer) {
            return false; // Organizer not found
        }

        auth('mobile')->user()->followingOrganizer()->syncWithoutDetaching([$organizerId]);

        return true; // Organizer attached successfully
    }

    public function detachFollowOrganizerFromUser($userId, $organizerId)
    {
        auth('mobile')->user()->followingOrganizer()->detach($organizerId);
    }

}
