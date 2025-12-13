<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // Example: get bookings for the logged-in user
        $bookings = Auth::user()->bookings ?? [];
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request)
{
    $request->validate([
        'destination_id' => 'required|exists:destinations,id',
        'travel_date' => 'required|date',
        'travel_end_date' => 'required|date|after_or_equal:travel_date',
        'people' => 'required|integer|min:1',
        'room' => 'required|integer|min:1',
    ]);

    Booking::create([
        'user_id' => Auth::user() ->id, 
        'destination_id' => $request->destination_id,
        'travel_date' => $request->travel_date,
        'travel_end_date' => $request->travel_end_date, 
        'people' => $request->people,
        'room' => $request->room,
    ]);

    return back()->with('success', 'Booking confirmed');
}

}
