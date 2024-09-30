<?php

namespace App\Services\web;

use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use App\Models\User\OrganizerUpdate;
use App\Scopes\ExcludeAttributeScope;
use Illuminate\Support\Facades\Auth;

class OrganizerRequestService
{
    public function getAllOrganizerRequests()
    {
        $results = Organizer::withoutGlobalScope(ExcludeAttributeScope::class)
            ->with(['mobileUser' , 'categories'])
            ->where('type', 'pending')
            ->get();
        return $results ;
    }
    
    public function updatedOrganizerRequests()
    {
        $results = OrganizerUpdate::withoutGlobalScope(ExcludeAttributeScope::class)
            ->with(['categories'])
            ->get();
        return $results ;
    }

    public function updateOrganizerRequest($id, $data)
    {
        $organizer = Organizer::withoutGlobalScope(ExcludeAttributeScope::class)->find($id);
        $organizer->update($data);
        $user = MobileUser::find($organizer->mobile_user_id) ;
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return $organizer;
    }

    public function deleteOrganizerRequest($id)
    {
        $organizer = Organizer::withoutGlobalScope(ExcludeAttributeScope::class)
            ->with('mobileUser')
            ->find($id);

        $user = MobileUser::find($organizer->mobileUser->id);

        $user->update([
            'type' => 'normal'
        ]);

        $organizer->delete();
    }
}
