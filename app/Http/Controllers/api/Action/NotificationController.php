<?php

namespace App\Http\Controllers\api\Action;

use App\Http\Controllers\Controller;
use App\Models\Action\Notification;

use App\Models\User\MobileUser;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function myNotification()
    {
        $user_id = Auth::id();
  $notifications = Notification::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(10);

        $response = response()->json([
            'status' => true,
            'Notification' => $notifications
        ]);

        foreach ($notifications as $notification) {
            $notification->update([
                'seen_type' => true,
                'live_type' => true
            ]);
        }

        return $response ;
    }

    public function sentNotification($user_id ,$title ,$body , $title_ar , $body_ar , $navigate = null)
    {
        $data = [
            'title' => $title,
            'body' => $body,
            'title_ar' => $title_ar,
            'body_ar' => $body_ar,
            'navigate' => $navigate
        ];

        $user = MobileUser::find($user_id) ;
        if (!$user) {
            return ;
        }
        $deviceTokens = $user->deviceTokens()->pluck('device_token')->toArray();

        if (empty($deviceTokens)) {
            return ;
        }
        $options = array(
            'notification' => array(
                'badge' => 1,
                'sound' => 'ping.aiff',
                'title' => $title,
                'body' => $body,
                'title_ar' => $title_ar,
                'body_ar' => $body_ar
            )
        );

        foreach ($deviceTokens as $deviceToken) {
            $this->sendPushNotification($data, [$deviceToken], $options);
        }
    }

    public function sendPushNotification($data, $to, $options) {
        // Insert your Secret API Key here
        $apiKey = 'fe7e657c791da1d5b5b1223432f494522231b8810bb1c644732d8604421a3d38';

        // Default post data to provided options or empty array
        $post = $options ?: array();

        // Set notification payload and recipients
        $post['to'] = $to;
        $post['data'] = $data;

        // Set Content-Type header since we're sending JSON
        $headers = array(
            'Content-Type: application/json'
        );

        // Initialize curl handle
        $ch = curl_init();

        // Set URL to Pushy endpoint
        curl_setopt($ch, CURLOPT_URL, 'https://api.pushy.me/push?api_key=' . $apiKey);

        // Set request method to POST
        curl_setopt($ch, CURLOPT_POST, true);

        // Set our custom headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Get the response back as string instead of printing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set post data as JSON
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post, JSON_UNESCAPED_UNICODE));

        // Actually send the push
        $result = curl_exec($ch);

        // Display errors
        if (curl_errno($ch)) {
            echo curl_error($ch);
        }

        // Close curl handle
        curl_close($ch);

        // Attempt to parse JSON response
        $response = @json_decode($result);

        // Throw if JSON error returned
        if (isset($response) && isset($response->error)) {
            throw new \Exception('Pushy API returned an error: ' . $response->error);
        }
    }

}
