<?php

namespace App\Models\Event;

use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EventCategory extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // Listen for the deleting event
        static::deleting(function ($object) {
            if ($object->icon) {
                Storage::disk('public')->delete($object->icon);
            }
        });
    }

    protected $fillable = ['title' , 'title_ar', 'icon'];

    public function users()
    {
        return $this->belongsToMany(MobileUser::class , 'event_category_mobile_user');
    }

    public function eventRequests()
    {
        return $this->hasMany(EventRequest::class, 'category_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_category_event');
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class , 'organizer_categories');
    }
}
