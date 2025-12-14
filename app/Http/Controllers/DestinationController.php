<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
class DestinationController extends Controller
{
   public function index(Request $request) {
    // $destinations = Destination::all();
    $query = Destination::where('available_rooms', '>', 0);

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }
  
    $destinations = $query->get();

        // Only get destinations with available rooms > 0 (no work with search function)
    // $destinations = \App\Models\Destination::where('available_rooms', '>', 0)->get();

    return view('destinations.index', compact('destinations'));
    }


    public function create() {
    return view('destinations.create');
    }


    public function store(Request $request) {
    Destination::create($request->all());
    return redirect()->route('destinations.index');
    }


    public function show(Destination $destination) {
    return view('destinations.show', compact('destination'));
    }


    public function edit(Destination $destination) {
    return view('destinations.edit', compact('destination'));
    }


    public function update(Request $request, Destination $destination) {
    $destination->update($request->all());
    return redirect()->route('destinations.index');
    }


    public function destroy(Destination $destination) {
    $destination->delete();
    return redirect()->route('destinations.index');
    }
}
