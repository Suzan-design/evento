namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Messaging;

class FirebaseNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $body;
    protected $deviceToken;

    public function __construct($title, $body, $deviceToken)
    {
        $this->title = $title;
        $this->body = $body;
        $this->deviceToken = $deviceToken;
    }

    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        $messaging = app(Messaging::class);

        $message = CloudMessage::withTarget('token', $this->deviceToken)
            ->withNotification(FirebaseNotification::create($this->title, $this->body))
            ->withData(['key' => 'value']);

        $messaging->send($message);
    }
}
