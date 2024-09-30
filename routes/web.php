<?php

use App\Http\Controllers\web\Organizer\OrganizerController;
use App\Models\User\Organizer;
use Illuminate\Support\Facades\Route;



Route::controller(\App\Http\Controllers\web\User\AuthController::class)->group(function () {
    Route::get('/' , 'login') ;
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});


Route::middleware(['auth:web', 'role:admin'])->group(function ()
{

    Route::get('dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');



    Route::resource('venues', \App\Http\Controllers\web\Venue\VenueController::class);
    Route::resource('events', \App\Http\Controllers\web\Event\EventController::class);
    Route::resource('event-requests', \App\Http\Controllers\web\Event\EventRequestController::class);
    Route::resource('organizer-requests', \App\Http\Controllers\web\Organizer\OrganizerRequestController::class);
    Route::resource('serviceProvider-requests', \App\Http\Controllers\web\Services\ServiceProviderRequestController::class);

    Route::resource('organizers', OrganizerController::class);

    Route::resource('services-categories', \App\Http\Controllers\web\Services\ServicesCategoryController::class);
    Route::resource('events-categories', \App\Http\Controllers\web\Event\EventsCategoryController::class);
    Route::resource('events-request-categories', \App\Http\Controllers\web\Event\EventRequestCategoryController::class);
    Route::resource('service-providers', \App\Http\Controllers\web\Services\ServiceProviderController::class);
    Route::resource('reels', \App\Http\Controllers\web\Common\ReelController::class);
    Route::get('reels.search' ,[\App\Http\Controllers\web\Common\ReelController::class , 'search'])->name('reels.search') ;
    Route::resource('events-offers', \App\Http\Controllers\web\Event\OfferController::class);

    Route::resource('interest', \App\Http\Controllers\web\Common\InterestController::class);

    Route::resource('promo_code', \App\Http\Controllers\web\Event\PromoCodeController::class);
    Route::post('code-count', [\App\Http\Controllers\web\Event\PromoCodeController::class, 'count'])->name('code-count');
    Route::resource('users', \App\Http\Controllers\web\User\UserController::class);
    Route::get('users.search' ,[\App\Http\Controllers\web\User\UserController::class , 'search'])->name('users.search') ;
    Route::get('changeType/{id}' ,[\App\Http\Controllers\web\User\UserController::class , 'changeType'])->name('users.changeType') ;
    Route::post('/users/change-active-type/{id}', [\App\Http\Controllers\web\User\UserController::class, 'changeActiveType'])->name('users.changeActiveType');

    Route::get('service_provider_review' , [\App\Http\Controllers\ReviewController::class , 'getServiceProviderReview'])->name('service_provider.review') ;
    Route::get('event_review' , [\App\Http\Controllers\ReviewController::class , 'getEventReview'])->name('event.review') ;
    Route::get('venue_review' , [\App\Http\Controllers\ReviewController::class , 'getVenueReview'])->name('venue.review') ;
    Route::delete('service_provider_review_delete/{service_provider_review}' , [\App\Http\Controllers\ReviewController::class , 'destroyServiceProviderReview'])->name('service_provider_review.destroy') ;
    Route::delete('event_review_delete/{event_review}' , [\App\Http\Controllers\ReviewController::class , 'destroyEventReview'])->name('event_review.destroy') ;
    Route::delete('venue_review_delete/{venue_review}' , [\App\Http\Controllers\ReviewController::class , 'destroyVenueReview'])->name('venue_review.destroy') ;



    Route::get('notification_index' , [\App\Http\Controllers\web\NotificationController::class , 'index'])->name('notification.index') ;
    Route::get('notification_dashboard' , [\App\Http\Controllers\web\NotificationController::class , 'dashboard'])->name('notification_dashboard') ;
    Route::post('sent_notification' , [\App\Http\Controllers\web\NotificationController::class , 'sentNotification'])->name('sent_notification') ;
    Route::post('user_count_notification' , [\App\Http\Controllers\web\NotificationController::class , 'getUsersCountNotification'])->name('user_count_notification') ;
    Route::get('event_ticket/{event_id}' , [\App\Http\Controllers\web\Event\EventController::class , 'eventTicket'])->name('event_ticket') ;
    
    Route::get('cancelled_bookings' , [\App\Http\Controllers\PaymentController::class , 'cancelled_bookings'])->name('cancelled_bookings') ;
    Route::get('acceptCancel/{id}' , [\App\Http\Controllers\PaymentController::class , 'acceptCancel'])->name('acceptCancel') ;
    Route::get('rejectCancel/{id}' , [\App\Http\Controllers\PaymentController::class , 'rejectCancel'])->name('rejectCancel') ;
    
    Route::get('updatedOrganizerRequests' , [\App\Http\Controllers\web\Organizer\OrganizerRequestController::class , 'updatedOrganizerRequests'])->name('updatedOrganizerRequests') ;
    Route::get('acceptUpdate/{id}' , [\App\Http\Controllers\web\Organizer\OrganizerRequestController::class , 'acceptUpdate'])->name('acceptUpdate') ;
    Route::get('rejectUpdate/{id}' , [\App\Http\Controllers\web\Organizer\OrganizerRequestController::class , 'rejectUpdate'])->name('rejectUpdate') ;
    

//Route::get('financial_report' , [\App\Http\Controllers\web\FinancialController::class , 'financial'])->name('financial') ;

});

Route::get('activate' , [\App\Http\Controllers\PaymentController::class , 'terminalActivation']) ;


