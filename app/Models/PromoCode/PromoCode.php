<?php

namespace App\Models\PromoCode;

use App\Models\Event\Event;
use App\Models\User\MobileUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class PromoCode extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'promo_codes' ;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new \App\Scopes\PromoCodeScope);
        // Listen for the deleting event
        static::deleting(function ($object) {
            // Check if the post has an image
            if ($object->image) {
                // Delete the image from storage
                Storage::disk('public')->delete($object->image);
            }
        });
    }

    protected $fillable = [
        'title',
        'description',
        'image' ,
        'code' ,
        'discount' ,
        'limit' ,
        'start-date' ,
        'end-date' ,
        'target_categories' ,
        'target_ages' ,
        'target_states' ,
        'target_bookings'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class , 'event_promo_code')->withoutGlobalScopes();
    }

    public function users()
    {
        return $this->belongsToMany(MobileUser::class , 'user_promo_code')->withoutGlobalScopes();
    }
}
