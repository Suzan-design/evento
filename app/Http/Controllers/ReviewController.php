<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Action\Review;
use App\Models\Action\ServiceProviderReview;
use App\Models\Action\VenueReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getServiceProviderReview()
    {
        $service_provider_reviews = ServiceProviderReview::all() ;
        return view('review.serviceProvider', compact('service_provider_reviews'));
    }
    public function getEventReview()
    {
        $event_reviews = Review::all();
        return view('review.event', compact('event_reviews'));
    }
    public function getVenueReview()
    {
        $venue_reviews = VenueReview::all();
        return view('review.venue', compact('venue_reviews'));
    }

    public function destroyServiceProviderReview(ServiceProviderReview $service_provider_review)
    {
        ServiceProviderReview::find($service_provider_review->id)->delete();
        return redirect()->route('service_provider.review')->with('success', 'offer deleted successfully.');
    }
    public function destroyEventReview(Review $event_review)
    {
        Review::find($event_review->id)->delete();
        return redirect()->route('event.review')->with('success', 'offer deleted successfully.');
    }
    public function destroyVenueReview(VenueReview $venue_review)
    {
        VenueReview::find($venue_review->id)->delete();
        return redirect()->route('venue.review')->with('success', 'offer deleted successfully.');
    }

}
