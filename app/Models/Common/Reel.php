<?php

namespace App\Models\Common;

use App\Models\Action\ReelComment;
use App\Models\Action\ReelLike;
use App\Models\Event\Event;
use App\Models\User\MobileUser;
use App\Models\User\Organizer;
use App\Models\Venue\Venue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Reel extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        // Listen for the deleting event
        static::deleting(function ($reel) {

            // Delete images
            if ($reel->images) {
                $images = json_decode($reel->images, true);
                if (is_array($images)) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            // Delete videos
            if ($reel->videos) {
                $videos = json_decode($reel->videos, true);
                if (is_array($videos)) {
                    foreach ($videos as $video) {
                        // Delete HLS files
                        $hlsFolder = dirname($video);
                        Storage::disk('public')->deleteDirectory($hlsFolder);
                    }
                }
            }
        });
    }

    protected $fillable = ['event_id', 'organizer_id','venue_id' , 'videos','images' , 'description' , 'description_ar'];

    public function event()
    {
        return $this->belongsTo(Event::class)->withoutGlobalScopes();
    }
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
    public function organizer()
    {
        return $this->belongsTo(Organizer::class)->withoutGlobalScopes();
    }

    public function likes()
    {
        return $this->hasMany(ReelLike::class , 'reel_id');
    }

    public function comments()
    {
        return $this->hasMany(ReelComment::class , 'reel_id');
    }

}