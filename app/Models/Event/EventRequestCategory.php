<?php

namespace App\Models\Event;

use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EventRequestCategory extends Model
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


    public function eventRequests()
    {
        return $this->hasMany(EventRequest::class, 'event_category_id');
    }


}
