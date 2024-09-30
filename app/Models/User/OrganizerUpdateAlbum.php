<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizerUpdateAlbum extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        // Listen for the deleting event
        static::deleting(function ($organzierAlbum) {

            if ($organzierAlbum->images) {
                $images = json_decode($organzierAlbum->images, true);
                if (is_array($images)) {
                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            if ($organzierAlbum->videos) {
                $videos = json_decode($organzierAlbum->videos, true);
                if (is_array($videos)) {
                    foreach ($videos as $video) {
                        Storage::disk('public')->delete($video);
                    }
                }
            }
        });
    }
    protected $table = "organizer_albums_updates";
    
    protected $fillable = [
        'name',
        'videos',
        'images',
        'organizer_update_id'
    ];

    public function organizerUpdate()
    {
        return $this->belongsTo(OrganizerUpdate::class);
    }
}
 