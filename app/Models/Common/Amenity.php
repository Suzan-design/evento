<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Amenity extends Model
{
    use HasFactory , SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($object) {
            if ($object->icon) {
                Storage::disk('public')->delete($object->icon);
            }
        });
    }
    protected $table = 'amenities' ;

    protected $fillable = [
        'icon' ,
        'title',
        'title_ar'
    ];

}
