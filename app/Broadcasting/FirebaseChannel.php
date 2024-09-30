<?php

namespace App\Broadcasting;

use App\Models\User\User;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Messaging;

class FirebaseChannel
{
    protected $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function send($notifiable, Notification $notification)
    {
        if (! $notifiable->routeNotificationFor('firebase')) {
            return;
        }

        $message = $notification->toFirebase($notifiable);

        $this->messaging->send($message);
    }
}