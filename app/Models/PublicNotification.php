<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicNotification extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',   'description' ,'title_ar',   'description_ar', 'target_categories' ,
        'target_ages' , 'target_states' ,'target_bookings'
    ] ;
}
