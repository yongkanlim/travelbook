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

    $destination = \App\Models\Destination::findOrFail($request->destination_id);

    // Check if enough rooms are available
    if ($request->room > $destination->available_rooms) {
        return back()->with('error', 'Not enough rooms available.');
    }

    // Decrease available rooms
    $destination->decrement('available_rooms', $request->room);


    return back()->with('success', 'Booking confirmed');
}

public function edit(Booking $booking)
    {
        // Ensure the booking belongs to the logged-in user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Ensure the booking belongs to the logged-in user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'travel_date' => 'required|date',
            'travel_end_date' => 'required|date|after_or_equal:travel_date',
            'people' => 'required|integer|min:1',
            'room' => 'required|integer|min:1',
        ]);

        $destination = $booking->destination;

        // Calculate how many rooms are available including this booking
        $availableRooms = $destination->available_rooms + $booking->room;

        if ($request->room > $availableRooms) {
            return back()->with('error', 'Not enough rooms available.');
        }

        // Update available rooms
        $destination->available_rooms = $availableRooms - $request->room;
        $destination->save();

        // Update booking
        $booking->update([
            'travel_date' => $request->travel_date,
            'travel_end_date' => $request->travel_end_date,
            'people' => $request->people,
            'room' => $request->room,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }
    public function destroy(Booking $booking)
    {
        // Ensure the booking belongs to the logged-in user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Restore the rooms to the destination before deleting
        $destination = $booking->destination;
        $destination->available_rooms += $booking->room;
        $destination->save();

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully!');
    }

}
