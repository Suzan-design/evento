<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'event_id' ,
        'percent',
        'discount_type',
        'status'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
