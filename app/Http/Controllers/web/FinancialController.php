<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use App\Models\Event\Booking;
use App\Models\Event\CancelledBooking;
use Illuminate\Http\Request;

class FinancialController extends Controller
{

public function financial()
{
    // Calculate total capacity of all events
    $totalTicketsNumber = Event::sum('capacity');

    // Calculate total booked tickets where status is paid
    $totalBookedTickets = Booking::where('status', 'paid')->count();

    // Calculate total cancelled tickets
    $totalCancelledTickets = CancelledBooking::count();

    // Calculate total ticket price for all booked tickets
   $totalBookedTicketsPrice = Booking::where('status', 'paid')
        ->join('invoices', 'bookings.invoice_id', '=', 'invoices.external_id')
        ->sum('invoices.amount');

    // Retrieve all cancelled bookings
    $totalCancelledTicketsPrice = CancelledBooking::sum('amount');
    
    dd('totalTicketsNumber :' . $totalTicketsNumber . 'totalBookedTickets:' . $totalBookedTickets . 'totalCancelledTickets:' . $totalCancelledTickets . 'totalBookedTicketsPrice:' . $totalBookedTicketsPrice . 'totalCancelledTicketsPrice:' . $totalCancelledTicketsPrice);
    return view('financial_report', [
        'totalTicketsNumber' => $totalTicketsNumber,
        'totalBookedTickets' => $totalBookedTickets,
        'totalCancelledTickets' => $totalCancelledTickets,
        'totalBookedTicketsPrice' => $totalBookedTicketsPrice,
        'totalCancelledTicketsPrice' => $totalCancelledTicketsPrice,
    ]);
}

}
