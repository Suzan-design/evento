<?php

namespace App\Models\User;

use App\Models\Event\Event;
use App\Models\Event\EventCategory;
use App\Scopes\ExcludeAttributeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Organizer extends Model
{
    use HasFactory , SoftDeletes;

    protected static function booted()
    {
        static::addGlobalScope(new ExcludeAttributeScope('type', 'pending'));

        parent::boot();

        static::deleting(function ($object) {
            if ($object->profile) {
                Storage::disk('public')->delete($object->profile);
            }
            if ($object->cover) {
                Storage::disk('public')->delete($object->cover);
            }
        });

    }

    protected $fillable = [
        'mobile_user_id',
        'name',
        'bio',
        'covering_area',
        'other_category',
        'profile',
        'cover' ,
        'type'
    ];

    protected $appends = ['is_followed_by_auth_user'];

    public function getIsFollowedByAuthUserAttribute()
    {
        return $this->followers()->where('mobile_user_id', auth()->id())->exists();
    }

    public function organizedEvents()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function followers()
    {
        return $this->belongsToMany(MobileUser::class, 'organizer_follows')->withoutGlobalScopes();
    }

    public function mobileUser()
    {
        return $this->belongsTo(MobileUser::class , 'mobile_user_id')->withTrashed();
    }

    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'organizer_categories');
    }

    public function albums()
    {
        return $this->hasMany(OrganizerAlbum::class);
    }
}
