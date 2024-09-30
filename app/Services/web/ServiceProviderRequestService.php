<?php

namespace App\Services\web;

use App\Models\Event\EventRequest;
use App\Models\ServiceProvider\ServiceProvider;
use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use App\Scopes\ExcludeAttributeScope;

class ServiceProviderRequestService
{
    public function getAllServiceProviderRequests()
    {
        return ServiceProvider::withoutGlobalScope(ExcludeAttributeScope::class)->with(['user'  , 'category'])->where('type' , 'pending')->get() ;
    }

    public function updateServiceProviderRequest($id, $data)
    {
        $service_provider = ServiceProvider::withoutGlobalScope(ExcludeAttributeScope::class)->find($id);
        $service_provider->update($data);

        $user = MobileUser::find($service_provider->user_id) ;
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return $service_provider;
    }

    public function deleteServiceProviderRequest($id)
    {
        $serviceProvider = ServiceProvider::withoutGlobalScope(ExcludeAttributeScope::class)
            ->with('user')
            ->find($id);

        $user = MobileUser::find($serviceProvider->user->id);

        $user->update([
            'type' => 'normal'
        ]);

        $serviceProvider->delete();
    }

}
