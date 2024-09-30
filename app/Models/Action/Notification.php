<?php

namespace App\Models\Action;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable=[
        'title' ,
        'description' ,
        'title_ar',
        'description_ar' ,
        'user_id' ,
        'seen_type' ,
        'live_type'
    ] ;
}
