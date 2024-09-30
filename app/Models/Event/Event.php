<?php

namespace App\Models\Event;

use App\Models\Common\Amenity;
use App\Models\Common\Reel;
use App\Models\PromoCode\PromoCode;
use App\Models\ServiceProvider\ServiceProvider;
use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use App\Models\Venue\Venue;
use App\Scopes\ReverseOrderScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory , SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ReverseOrderScope());
        static::addGlobalScope(new \App\Scopes\UpcomingEventScope);

        // Listen for the deleting event
        static::deleting(function ($event) {

            if ($event->images) {
                $images = json_decode($event->images, true);
                if (is_array($images)) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            if ($event->videos) {
                $videos = json_decode($event->videos, true);
                if (is_array($videos)) {
                    foreach ($videos as $video) {
                        Storage::disk('public')->delete($video);
                    }
                }
            }
        });
    }
    
    public function getTicketPriceByClassType($classType)
    {
        
        $ticketClass = $this->classes()->where('code', $classType)->first();
        return $ticketClass ? $ticketClass->price : 0;
    }

    protected $fillable = [
        'organizer_id' , 'title' , 'title_ar', 'venue_id', 'capacity', 'start_date', 'end_date', 'ticket_price', 'description' , 'description_ar' , 'type'
        , 'images' , 'videos' , 'app_taxes' , 'website' , 'instagram' , 'facebook' , 'cancellation_time' , 'discount_type',
        'refund_policy' , 'cancellation_policy' , 'refund_policy_ar' , 'cancellation_policy_ar','ecash_taxes'
    ];

    protected $appends = ['is_followed_by_auth_user' ];

    public function getIsFollowedByAuthUserAttribute()
    {
        return $this->followers()->where('mobile_user_id', Auth::id())->exists();
    }

    public function followers()
    {
        return $this->belongsToMany(MobileUser::class, 'event_follows');
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class , 'organizer_id')->withTrashed() ;
    }

    public function serviceProviders()
    {
        return $this->belongsToMany(ServiceProvider::class , 'event_service_provider');
    }

    public function eventTrips()
    {
        return $this->hasMany(EventTrip::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_event', 'event_id', 'amenity_id')
            ->withPivot('price', 'description' , 'description_ar') ;
    }

    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_category_event') ;
    }

    public function classes()
    {
        return $this->hasMany(EventClass::class) ;
    }

    public function reels()
    {
        return $this->hasMany(Reel::class);
    }

    public function eventsLikes()
    {
        return $this->hasMany(EventLike::class);
    }

    public function eventsComments()
    {
        return $this->hasMany(EventComment::class);
    }

    public function allowsPromoCode($promoCodeId)
    {
        return $this->promoCodes()->where('promo_code_id', $promoCodeId)->exists();
    }

    public function promoCodes()
    {
        return $this->belongsToMany(PromoCode::class , 'event_promo_code');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class , 'event_id');
    }

    public function scopeNearest($query, $lat, $lng, $radius)
    {
        $haversine = "(6371 * acos(cos(radians($lat))
                   * cos(radians(venues.latitude))
                   * cos(radians(venues.longitude)
                   - radians($lng))
                   + sin(radians($lat))
                   * sin(radians(venues.latitude))))";
        return $query->join('venues', 'events.venue_id', '=', 'venues.id')
            ->selectRaw("events.* , {$haversine} AS distance")
            ->havingRaw("distance <= ?", [$radius])
            ->orderBy('distance');
    }


    protected $hidden = [
        'created_at' ,
        'updated_at'
    ] ;
}
