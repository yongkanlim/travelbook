<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\AttractionBooking; // Create this model if needed

class AttractionBookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'attraction_id' => 'required|exists:attractions,id',
            'adult_tickets' => 'required|integer|min:0',
            'child_tickets' => 'required|integer|min:0',
        ]);

        $attraction = Attraction::findOrFail($request->attraction_id);

        // Optional: Check available tickets
        if ($request->adult_tickets > $attraction->available_adult_tickets ||
            $request->child_tickets > $attraction->available_child_tickets) {
            return back()->withErrors('Not enough tickets available.');
        }

        // Create booking
        // Make sure you have a model & migration for AttractionBooking
        AttractionBooking::create([
            'attraction_id' => $attraction->id,
            'adult_tickets' => $request->adult_tickets,
            'child_tickets' => $request->child_tickets,
            'total_price' => $request->adult_tickets * $attraction->adult_price
                           + $request->child_tickets * $attraction->child_price,
        ]);

        // Optionally reduce available tickets
        $attraction->decrement('available_adult_tickets', $request->adult_tickets);
        $attraction->decrement('available_child_tickets', $request->child_tickets);

        return redirect()->back()->with('success', 'Tickets booked successfully!');
    }
}
