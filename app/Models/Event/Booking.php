<?php

namespace App\Models\Event;

use App\Models\Common\Amenity;
use App\Models\PromoCode\PromoCode;
use App\Models\User\MobileUser;
use App\Scopes\ExcludeAttributeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Add global scope in the constructor
        static::addGlobalScope(new ExcludeAttributeScope('status', 'pending'));
    }


    protected $fillable = [
        'user_id',
        'event_id' ,
        'class_id' ,
        'invoice_id',
        'user_phone_number' ,
        'event_title' ,
        'class_type' ,
        'first_name' ,
        'last_name'  ,
        'age' ,
        'phone_number',
        'amenities' ,
        'class_ticket_price' ,
        'promo_code_id' ,
        'offer_id' ,
        'status'
    ];

    public function getAmenitiesAttribute()
    {
        $amenityIds = json_decode($this->attributes['amenities'], true);

        return Amenity::whereIn('id', $amenityIds)->withTrashed()->get();
    }

    public function user()
    {
        return $this->belongsTo(MobileUser::class , 'user_id')->withTrashed() ;
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id')->withTrashed();
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id')->withoutGlobalScopes() ;
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id')->withoutGlobalScopes() ;
    }

    protected $hidden = [
        'created_at' ,
        'updated_at'
    ] ;
}


