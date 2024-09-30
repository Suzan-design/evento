<?php

namespace App\Models\Event;

use App\Models\PromoCode\PromoCode;
use App\Models\User\MobileUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'user_phone_number' ,
        'event_title',
        'class_type' ,
        'first_name',
        'last_name',
        'age',
        'phone_number',
        'amenities',
        'class_ticket_price' ,
        'amount',
        'promo_code_id' ,
        'reason',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(MobileUser::class , 'user_id')->withTrashed() ;
    }
    public function event()
    {
        return $this->belongsTo(Event::class , 'event_id') ;
    }
    public function eventClass()
    {
        return $this->belongsTo(EventClass::class, 'class_id');
    }
    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id')->withTrashed() ;
    }

}
