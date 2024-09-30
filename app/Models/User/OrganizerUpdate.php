<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organizer;
use App\Models\Event\EventCategory;

class OrganizerUpdate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'organizer_id',
        'name',
        'bio',
        'covering_area',
        'other_category',
        'profile',
        'cover'
    ];
    
    public function organizer()
    {
        return $this->belongsTo(Organizer::class , 'organizer_id')->withTrashed();
    }
    
    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'updated_organizer_categories');
    }

    public function albums()
    {
        return $this->hasMany(OrganizerUpdateAlbum::class);
    }
}
