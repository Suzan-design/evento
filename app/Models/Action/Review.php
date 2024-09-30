<?php

namespace App\Models\Action;

use App\Models\Event\Event;
use App\Models\User\MobileUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table='reviews' ;

    protected $fillable =[
        'user_id' ,
        'event_id'  ,
        'rate' ,
        'comment'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class , 'event_id')->withoutGlobalScopes() ;
    }

    public function mobile_user()
    {
        return $this->belongsTo(MobileUser::class , 'user_id')->withoutGlobalScopes() ;
    }
}
