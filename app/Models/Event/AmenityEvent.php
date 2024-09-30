<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmenityEvent extends Model
{
    use HasFactory;

    protected $table = 'amenity_event' ;

    protected $fillable = [
        'event_id' ,
        'amenity_id' ,
        'price' ,
        'description' ,
        'description_ar'
    ] ;

}
