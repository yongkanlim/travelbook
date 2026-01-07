<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\AttractionBooking;
use Illuminate\Support\Facades\Auth;

class AttractionBookingController extends Controller
{
    /**
     * Show all attraction bookings for logged-in user
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // Gets currently authenticated user

        // $user->attractionBookings() - Uses Eloquent relationship (User has many attraction bookings)
        // User model need have a attractionbookings() function that use hasMany()
        $attractionBookings = $user->attractionBookings()
            ->with('attraction')
            ->latest()
            ->get();
        // ->with('attraction') Allows you to safely use {{ $booking->attraction->name }}
        // Without with('attraction'), Laravel would Run 1 query for bookings, Then 1 query per booking → very slow
        // ->latest() - Sorts by newest booking first
        // ->get() - executes the query

        return view('attractionbooking.index', compact('attractionBookings'));
    }

    /**
     * Store new attraction booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'attraction_id' => 'required|exists:attractions,id',
            'adult_tickets' => 'required|integer|min:0',
            'child_tickets' => 'required|integer|min:0',
        ]);

        // Finds the attraction by ID, If not found → 404 error
        $attraction = Attraction::findOrFail($request->attraction_id);

        // At least one ticket must be booked
        if ($request->adult_tickets + $request->child_tickets === 0) {
            return back()->with('error', 'Please select at least one ticket.');
        }

        // Check availability
        if (
            $request->adult_tickets > $attraction->available_adult_tickets ||
            $request->child_tickets > $attraction->available_child_tickets
        ) {
            return back()->with('error', 'Not enough tickets available.');
        }

        // Calculate total price
        $totalPrice =
            ($request->adult_tickets * $attraction->adult_price) +
            ($request->child_tickets * $attraction->child_price);

        // Create booking
        AttractionBooking::create([
            'user_id' => Auth::id(),
            'attraction_id' => $attraction->id,
            'adult_tickets' => $request->adult_tickets,
            'child_tickets' => $request->child_tickets,
            'total_price' => $totalPrice,
            'visit_date' => now(), // or pass from form if needed
        ]);

        // Reduce available tickets
        $attraction->decrement('available_adult_tickets', $request->adult_tickets);
        $attraction->decrement('available_child_tickets', $request->child_tickets);

        return redirect()
            ->route('attractionbooking.index')
            ->with('success', 'Attraction tickets booked successfully!');
    }

    /**
     * Delete booking
     */
    public function destroy(AttractionBooking $attractionBooking)
    {
        // Security check
        if ($attractionBooking->user_id !== Auth::id()) {
            abort(403);
        }

        // Restore tickets
        $attraction = $attractionBooking->attraction;
        $attraction->available_adult_tickets += $attractionBooking->adult_tickets;
        $attraction->available_child_tickets += $attractionBooking->child_tickets;
        $attraction->save();

        $attractionBooking->delete();

        return redirect()
            ->route('attractionbooking.index')
            ->with('success', 'Attraction booking deleted successfully!');
    }

    // AttractionBooking $attractionBooking - Route Model Binding is used, Laravel automatically Reads the booking ID from the URL
    public function edit(AttractionBooking $attractionBooking)
    {
        // Prevents users from editing other users' bookings
        if ($attractionBooking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('attractionbooking.edit', compact('attractionBooking'));
    }

    public function update(Request $request, AttractionBooking $attractionBooking)
    {
        if ($attractionBooking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'visit_date' => 'required|date',
            'adult_tickets' => 'required|integer|min:0',
            'child_tickets' => 'required|integer|min:0',
        ]);

        if ($request->adult_tickets + $request->child_tickets === 0) {
            return back()->with('error', 'Please select at least one ticket.');
        }

        // Uses Eloquent relationship, Each booking belongs to one attraction
        $attraction = $attractionBooking->attraction;

        // Restore old tickets - because user need edit, so mean available ticket also need count the old one inside
        $attraction->available_adult_tickets += $attractionBooking->adult_tickets;
        $attraction->available_child_tickets += $attractionBooking->child_tickets;

        // Check availability
        if (
            $request->adult_tickets > $attraction->available_adult_tickets ||
            $request->child_tickets > $attraction->available_child_tickets
        ) {
            return back()->with('error', 'Not enough tickets available.');
        }

        // Update booking
        $attractionBooking->update([
            'visit_date' => $request->visit_date,
            'adult_tickets' => $request->adult_tickets,
            'child_tickets' => $request->child_tickets,
            'total_price' =>
                ($request->adult_tickets * $attraction->adult_price) +
                ($request->child_tickets * $attraction->child_price),
        ]);

        // Deduct new tickets
        $attraction->available_adult_tickets -= $request->adult_tickets;
        $attraction->available_child_tickets -= $request->child_tickets;
        // saves any changes made to the $attraction model back to the database.
        $attraction->save();

        return redirect()
            ->route('attractionbooking.index')
            ->with('success', 'Attraction booking updated successfully!');
    }

}
