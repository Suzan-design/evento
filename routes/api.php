<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(\App\Http\Controllers\api\RegisterController::class)->group(function (){
    Route::post('signup_step1' , 'SignUpStep1') ;
    Route::post('signup_step2' , 'SignUpStep2')->middleware(['auth:sanctum' , 'is_verified']) ;

    Route::post('login',  'LogIn');

    Route::post('logout' , 'LogOut')->middleware(['auth:sanctum' , 'is_verified' ,'is_complete']) ;
});

Route::controller(\App\Http\Controllers\api\AuthOtpController::class )->group(function (){
    Route::post('sendOTP' , 'generate')  ;
    Route::post('checkOTP' , 'OtpVerifyAccount')  ;
});

Route::controller(\App\Http\Controllers\api\ForgotPasswordController::class)->group(function (){
   Route::post('sendCode' , 'userForgotPassword')  ;
   Route::post('checkCode' , 'userCheckCode')  ;
   Route::post('changePassword' , 'userResetPassword')  ;
});

Route::middleware(['is_verified' , 'auth:sanctum'])->group(function (){
    Route::controller(\App\Http\Controllers\api\EventCategoryUserController::class)->group(function(){
        Route::get('interest' , 'index') ;
        Route::get('userInterest' , 'user_favorite_categories') ;
        Route::post('storeUserInterest', 'store');
    });
});



//guest
Route::group([], function() {
    Route::controller(\App\Http\Controllers\api\HomeController::class)->group(function() {
        Route::get('eventAccordingCategory-guest/{id}', 'eventAccordingCategory');
        Route::get('event_category-guest', 'category');
        Route::get('featured_event-guest', 'featured_event');
        Route::get('trending_event-guest', 'trending_event');
        Route::get('offer_event-guest' , 'OfferEvent');
        Route::get('toNight-guest' , 'toNightEvent');
        Route::get('thisWeek-guest' , 'thisWeekEvent');
    });
    Route::controller(\App\Http\Controllers\api\ServiceProviderController::class)->group(function () {
        Route::get('service_provider-guest/{id}', 'show');
    });
    Route::controller(\App\Http\Controllers\api\VenueController::class)->group(function (){
        Route::get('venue-guest/{id}' , 'show') ;
        Route::get('venue-guest' , 'index') ;
    });
    
    Route::controller(\App\Http\Controllers\api\BookingController::class)->group(function () {
      Route::get('/booking/{id}' , 'get_ticket');
    });
    
    Route::controller(\App\Http\Controllers\api\ReelController::class)->group(function() {
        Route::get('/reels-guest', 'index');
        Route::get('/reels-show-guest/{id}', 'show');
    });
    Route::controller(\App\Http\Controllers\api\EventController::class)->group(function (){
        Route::get('event-guest/{id}' , 'show') ;
        Route::post('filter-guest' , 'filter') ;
        Route::post('event_search-guest' , 'search') ;
    });
});

Route::middleware(['is_verified' ,'is_complete' ,'auth:sanctum'])->group(function (){
    Route::controller(\App\Http\Controllers\api\ProfileController::class)->group(function (){
        Route::get('/profile', 'profile');
        Route::get('/user/{id}', 'GetUser');
        Route::post('/user/update', 'update');
        Route::delete('/user/delete', 'destroy');
        Route::post('/user/reset-password','resetPassword');
        Route::get('change_type' , 'change_type') ;
        Route::post('searchFriend' , 'searchFriend') ;
    });

    Route::controller(\App\Http\Controllers\api\HomeController::class)->group(function(){
        Route::get('eventAccordingCategory/{id}', 'eventAccordingCategory');
        Route::get('event_category', 'category');
        Route::get('featured_event', 'featured_event');
        Route::get('trending_event', 'trending_event');
        Route::get('offer_event' , 'OfferEvent');
        Route::get('toNight' , 'toNightEvent');
        Route::get('thisWeek' , 'thisWeekEvent');

        Route::get('organizer_event' , 'organizer_event');
        Route::get('eventsInUserCity' , 'eventsInUserCity');
        Route::get('getJustForYouEvents' , 'getJustForYouEvents');
        Route::get('Home-Organizer' ,'organizer');
    });

    Route::controller(\App\Http\Controllers\api\VenueController::class)->group(function (){
        Route::get('venue/{id}' , 'show') ;
        Route::get('venue' , 'index') ;
    });

    Route::controller(\App\Http\Controllers\api\EventController::class)->group(function (){
        Route::get('event/{id}' , 'show') ;
        Route::post('filter' , 'filter') ;
        Route::post('favorite_filter' , 'favorite_filter') ;
        Route::post('event_search' , 'search') ;
        Route::post('filter_nearest','showNearestEvents') ;
        Route::get('showGoing/{id}','showGoing') ;
        Route::post('Invite', 'invite');
    });
    Route::controller(\App\Http\Controllers\api\BookingController::class)->group(function () {
//        Route::post('book' , 'book');
        Route::get('my_booking' , 'myBookings') ;
        Route::get('/my-cancelled-bookings', 'myCancelledBookings');
        
    });

    Route::controller(\App\Http\Controllers\api\ServiceProviderController::class)->group(function (){
        Route::get('service_provider/{id}', 'show');
        Route::get('service_category' , 'service_category') ;
        Route::get('serviceAccordingCategory/{id}' , 'serviceProviderAccordingCategory') ;
        Route::post('become_service_provider' , 'become_service_provider') ;
    });


    Route::controller(\App\Http\Controllers\api\EventRequestController::class)->group(function(){
       Route::post('sendEventRequest' , 'store') ;
       Route::get('my_request' , 'my_request');
       Route::get('event_request_categories' , 'getEventRequestCategory');
    });

    Route::controller(\App\Http\Controllers\api\Action\OrganizerFollowController::class)->group(function(){
        Route::get('/follow/{id}' ,'store') ;
        Route::get('/unfollow/{id}' ,'destroy') ;
    });

    Route::controller(\App\Http\Controllers\api\Action\FriendRequestController::class)->group(function(){
        Route::get('/friend-request/{id}' , 'store') ;
        Route::get('/friend-request/deny/{id}' , 'deny') ;
        Route::get('/friend-request/cancel/{id}' , 'destroy') ;
        Route::get('/friend-request/approve/{id}', 'approve');
        Route::get('/my-friends',  'myFriend');
        Route::get('/my-sent-requests',  'mySentRequest');
        Route::get('/my-received-requests', 'myReceiveRequest');
    });

    Route::controller(\App\Http\Controllers\api\Action\ReviewController::class)->group(function(){
        Route::post('/event-review' ,'store') ;
    });

    Route::controller(\App\Http\Controllers\api\Action\ServiceProviderReviewController::class)->group(function(){
        Route::post('/service-provider-review' ,'store') ;
    });

    Route::controller(\App\Http\Controllers\api\Action\VenueReviewController::class)->group(function(){
        Route::post('/venue-review' ,'store') ;
    });

    Route::controller(\App\Http\Controllers\api\Action\EventFollowController::class)->group(function(){
        Route::get('/event_follow/{id}' ,'store') ;
        Route::get('/event_unfollow/{id}' ,'destroy') ;
        Route::get('/my_favorite' , 'following_event');
    });

    Route::controller(\App\Http\Controllers\api\OrganizerController::class)->group(function() {
        Route::post('become_organizer', 'become_organizer');
        Route::get('organizer_profile/{id}' , 'getOrganizerProfile') ;
        Route::get('organizer_followers/{id}' , 'getOrganizerFollowers') ;
    });

    Route::controller(\App\Http\Controllers\api\ReelController::class)->group(function(){
        Route::get('/reels', 'index');
        Route::get('/reels-show/{id}', 'show');
        Route::get('/reels/{reelId}/like', 'addLike');
        Route::post('/reels/{reelId}/comment',  'addComment');
    });

    Route::controller(\App\Http\Controllers\api\Action\NotificationController::class)->group(function (){
       Route::get('notification' , 'myNotification') ;
    });

    Route::controller(\App\Http\Controllers\api\PromoCodeController::class)->group(function (){
        Route::get('/my_promo_code', 'my_promo_code');
        Route::get('/my_promo_code_booking/{event_id}', 'my_promo_code_booking');
    });

    Route::controller(\App\Http\Controllers\api\OrganizerSection\OrganizerController::class)->group(function(){
        Route::get('/organizer/followers',  'organizerFollowers');
        Route::get('/organizer/profile',  'getOrganizerProfile');
        Route::get('/organizer/event-booking/{eventId}','eventBooking');
        Route::get('/organizer/my-events','myEvent');
        Route::post('/organizer/updateProfile','updateProfileRequest');
        Route::post('/organizer/getUserBooking','getUserBooking');
    });

    Route::controller(\App\Http\Controllers\PaymentController::class)->group(function(){
        Route::post('/checkout/ecash', 'checkoutWithECash');
        Route::post('/invoice/create','createInvoice');
        Route::post('/invoice/confirmPayment','confirmPayment') ;
        Route::post('/booking/cancel', 'cancelBooking');
        Route::post('/booking/calculate_invoice_amount', 'calculate_invoice_amount');
        Route::post('/booking/resell_ticket', 'resellBooking');
    });
});

Route::post('/ecash/callback', [\App\Http\Controllers\PaymentController::class, 'ecashCallback'])->name('payment.callback');
Route::get('/payment/success', [\App\Http\Controllers\PaymentController::class, 'paymentSuccess'])->name('payment.success');

Route::post('/send-test-notification', function (Request $request) {
    // Validate the incoming request
         $title = "Test Notification";
        $body = "This is a test notification sent via Firebase.";
        $deviceToken = $request->device_token;
        $messaging = (new Factory)
                ->withServiceAccount(config('firebase.credentials.file'))
                ->createMessaging();
            $message = CloudMessage::withTarget('token', $deviceToken)
                  ->withNotification(FirebaseNotification::create($title, $body))
                  ->withData(['key' => 'value']); // Optional data payload
        // Send the notification
        try {
 $messaging->send($message);
            return response()->json([
                'success' => 'Notification sent successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to send notification.',
                'message' => $e->getMessage()
            ], 500);
        }
});