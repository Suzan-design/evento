<?php

namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use App\Models\Event\Booking;
use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $date;
    public $description;
    public $id;

    /**
     * Create a new event instance.
     */
    public function __construct($title  , $description ,$id)
    {
        $this->title = $title ;
        $this->date = Carbon::now() ;
        $this->description= $description ;
        $this->id = $id ;
    }

    public function broadcastOn(): array
    {
        return  [
            new Channel('notification'.$this->id)
            ];
    }

}
