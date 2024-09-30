<?php

namespace App\Models\User;

use App\Models\Action\FriendRequest;
use App\Models\Event\Booking;
use App\Models\Event\CancelledBooking;
use App\Models\Event\Event;
use App\Models\Event\EventCategory;
use App\Models\Event\EventComment;
use App\Models\Event\EventRequest;
use App\Models\Event\EventLike;
use App\Models\PromoCode\PromoCode;
use App\Models\ServiceProvider\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class MobileUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles ,SoftDeletes;

    protected static function boot()
    {
        parent::boot();

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
         'first_name' , 'last_name', 'email_verified_at', 'password', 'gender' , 'phone_number', 'state' , 'birth_date' , 'image' , 'is_complete'  ,'is_verified' , 'type' , 'active_type'
    ];

    protected $appends = ['friend_request_status_with_auth_user'];

    public function getFriendRequestStatusWithAuthUserAttribute()
    {
        if (!Auth::check()) {
            return null;
        }

        $authUserId = Auth::id();
        $otherUserId = $this->id;

        // Check for pending friend requests
        $pendingFriendRequest = FriendRequest::where(function ($query) use ($authUserId, $otherUserId) {
            $query->where('sender_id', $authUserId)
                ->where('receiver_id', $otherUserId)
                ->where('status', 'pending');
        })->orWhere(function ($query) use ($authUserId, $otherUserId) {
            $query->where('sender_id', $otherUserId)
                ->where('receiver_id', $authUserId)
                ->where('status', 'pending');
        })->first();

        if ($pendingFriendRequest) {
            return $pendingFriendRequest->sender_id == $authUserId ? 'pending' : 'received';
        }

        // Check for approved friend requests
        $approvedFriendRequest = FriendRequest::where(function ($query) use ($authUserId, $otherUserId) {
            $query->where('sender_id', $authUserId)
                ->where('receiver_id', $otherUserId);
        })->orWhere(function ($query) use ($authUserId, $otherUserId) {
            $query->where('sender_id', $otherUserId)
                ->where('receiver_id', $authUserId);
        })
            ->where('status', 'approve') // Make sure this status string is correct
            ->first();

        if ($approvedFriendRequest) {
            return 'is_friend';
        }


        return null;
    }

    public function updatePassword($newPassword)
    {
        $this->password = Hash::make($newPassword);
        $this->save();
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class , 'mobile_user_id') ;
    }


    public function followingOrganizer()
    {
        return $this->belongsToMany(Organizer::class, 'organizer_follows');
    }

    public function followingOrganizersCount()
    {
        return $this->belongsToMany(Organizer::class, 'organizer_follows')->count();
    }

    public function followingEvent()
    {
        return $this->belongsToMany(Event::class, 'event_follows');
    }

    public function organizerInfo()
    {
        return $this->hasOne(Organizer::class, 'mobile_user_id');
    }

    public function invoices()
    {
        return $this->hasMany(MobileUser::class, 'mobile_user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class , 'user_id') ;
    }

    public function cancelledBookings()
    {
        return $this->hasMany(CancelledBooking::class , 'user_id') ;
    }

    public function eventCategories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_category_mobile_user', 'mobile_user_id', 'events_category_id');
    }

    public function serviceProvider()
    {
        return $this->hasOne(ServiceProvider::class);
    }

    public function eventsComments()
    {
        return $this->hasMany(EventComment::class);
    }

    public function eventsLikes()
    {
        return $this->hasMany(EventLike::class);
    }

    public function eventRequests()
    {
        return $this->hasMany(EventRequest::class);
    }

    public function hasPromoCode($promoCodeId)
    {
        return $this->promoCodes()->where('promo_code_id', $promoCodeId)->exists();
    }

    public function promoCodes()
    {
        return $this->belongsToMany(PromoCode::class, 'user_promo_code');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_complete' ,
        'is_verified' ,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

}
