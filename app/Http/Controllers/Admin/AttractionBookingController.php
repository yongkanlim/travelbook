<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttractionBooking;
use App\Models\Attraction;
use Illuminate\Http\Request;

class AttractionBookingController extends Controller
{
    /**
     * Display a listing of attraction bookings.
     */
    public function index(Request $request)
    {
        $query = AttractionBooking::with(['user', 'attraction']);

        // Search by user or attraction
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('attraction', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $bookings = $query->latest()->paginate(10);

        return view('admin.attractionbooking.index', compact('bookings'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(AttractionBooking $attractionbooking)
    {
        $attractions = Attraction::all();

        return view('admin.attractionbooking.edit', [
            'booking' => $attractionbooking,
            'attractions' => $attractions,
        ]);
    }

    /**
     * Update the specified booking.
     */
    public function update(Request $request, AttractionBooking $attractionbooking)
    {
        $request->validate([
            'attraction_id' => 'required|exists:attractions,id',
            'visit_date' => 'required|date',
            'adult_tickets' => 'required|integer|min:0',
            'child_tickets' => 'required|integer|min:0',
        ]);

        $attractionbooking->update([
            'attraction_id' => $request->attraction_id,
            'visit_date' => $request->visit_date,
            'adult_tickets' => $request->adult_tickets,
            'child_tickets' => $request->child_tickets,
        ]);

        return redirect()
            ->route('admin.attractionbooking.index')
            ->with('success', 'Attraction booking updated successfully.');
    }

    /**
     * Remove the specified booking.
     */
    public function destroy(AttractionBooking $attractionbooking)
    {
        $attractionbooking->delete();

        return redirect()
            ->route('admin.attractionbooking.index')
            ->with('success', 'Attraction booking deleted successfully.');
    }
}
