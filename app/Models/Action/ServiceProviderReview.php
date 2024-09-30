<?php

namespace App\Models\Action;

use App\Models\Event\Event;
use App\Models\ServiceProvider\ServiceProvider;
use App\Models\User\MobileUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderReview extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id' ,
        'service_provider_id'  ,
        'rate' ,
        'comment'
    ];

    public function service_provider()
    {
        return $this->belongsTo(ServiceProvider::class , 'service_provider_id')->withoutGlobalScopes() ;
    }

    public function mobile_user()
    {
        return $this->belongsTo(MobileUser::class , 'user_id')->withoutGlobalScopes() ;
    }

}
