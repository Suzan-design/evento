<?php
namespace App\Models\Event;

use App\Models\Common\Amenity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventClass extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'code', 'ticket_price' , 'ticket_number' , 'description' , 'description_ar'];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'class_amenity');
    }

    public function event()
    {
        return $this->belongsTo(Event::class , 'event_id');
    }

    protected $hidden = [
        'created_at' ,
        'updated_at'
    ] ;

}
