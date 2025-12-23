<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query();

        // Apply search if provided
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        $destinations = $query->latest()->get();

        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // allow empty
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'people' => 'required|integer|min:1|max:10',
            'available_rooms' => 'required|integer|min:0',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        // Create destination with validated fields
        Destination::create($validated);

        return redirect()->route('admin.destinations.index')
                        ->with('success', 'Destination created successfully');
    }


    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $destination->update($request->all());
        return redirect()->route('admin.destinations.index')
                         ->with('success', 'Destination updated');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')
                         ->with('success', 'Destination deleted');
    }
}
