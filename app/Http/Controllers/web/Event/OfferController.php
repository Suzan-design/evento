<?php

namespace App\Http\Controllers\web\Event;

use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use App\Models\Event\Offer;
use App\Scopes\ExcludeAttributeScope;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{

    public function index()
    {
        $offers = Offer::with(['event' => function ($query) {
            $query->withoutGlobalScopes() ; // This removes all global scopes for the event relationship
        }])->get();

        return view('offer.index', compact('offers'));
    }

    public function create()
    {
        $events = Event::select('id' ,'title' , 'start_date' )->get() ;
        return view('offer.create' , compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'discount_type' => 'required|in:percent,amount',
            'discount_percent' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:100',
            'discount_amount' => 'required_if:discount_type,amount|nullable|numeric|min:0',
        ]);
        
        $offers = Offer::where('event_id',$request->event_id)->get();
        foreach($offers as $offer){
            $offer->update(['status'=>'expired']);
        }
    
        $data = $request->only('event_id', 'discount_type');
    
        if ($request->discount_type === 'percent') {
            $data['percent'] = $request->discount_percent;
        } else if ($request->discount_type === 'amount') {
            $data['percent'] = $request->discount_amount;
        }
    
        Offer::create($data);
        return redirect()->route('events-offers.index')->with('success', 'Offer created successfully.');
    }

    public function destroy(Offer $events_offer)
    {
        $events_offer->delete();
        return redirect()->route('events-offers.index')->with('success', 'offer deleted successfully.');
    }
}
