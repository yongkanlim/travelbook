<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attraction;

class AttractionController extends Controller
{
    public function index(Request $request)
    {
        // Starts a new query on the attractions table = SELECT * FROM attractions
        $query = Attraction::query();

        // --------------------------------------------------------------------------------------------------------------------------------
        // $request->has('search') → checks if the search input exists in the request (e.g., the search form inside admin.attraction.index.php).
        // !empty($request->search) → ensures the input is not empty. / $request->search != ''
        // $search = $request->search; → stores the search term to use in the query.
        // ---------------------------------------------------------------------------------------------------------------------------------
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        $attractions = $query->latest()->get();
        // ->latest() - Sorts by newest booking first
        // ->get() - executes the query

        return view('admin.attractions.index', compact('attractions'));
    }

    public function create()
    {
        return view('admin.attractions.create');
    }

    public function store(Request $request)
    {
        // Validate all fields including new ones
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'adult_price' => 'required|numeric|min:0',
            'child_price' => 'required|numeric|min:0',
            'available_adult_tickets' => 'required|integer|min:0',
            'available_child_tickets' => 'required|integer|min:0',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // image: required, must be an image file of allowed types (jpeg, png, jpg, gif, webp), max size 2 MB.

        // ============================================================================================================================
        // Save image file to public storage (Anyone can view image)
        // ============================================================================================================================
        // 1. $request->hasFile('image') = checks if an image was uploaded.
        // 2. $request->file('image')->store('attractions', 'public') = moves the uploaded file to storage/app/public/attractions
        // & Generates a unique filename automatically.
        // 3. $validated['image'] = '/storage/' . $imagePath; = Prepares the public URL for the image (/storage/attractions/abc123.jpg)
        // ============================================================================================================================ 

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('attractions', 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        // Saves the validated data to the attractions table.
        Attraction::create($validated);

        return redirect()->route('admin.attractions.index')
                        ->with('success', 'Attraction created successfully');
    }

    public function edit(Attraction $attraction)
    {
        return view('admin.attractions.edit', compact('attraction'));
    }

    public function update(Request $request, Attraction $attraction)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'adult_price' => 'required|numeric|min:0',
            'child_price' => 'required|numeric|min:0',
            'available_adult_tickets' => 'required|integer|min:0',
            'available_child_tickets' => 'required|integer|min:0',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($attraction->image && file_exists(public_path($attraction->image))) {
                unlink(public_path($attraction->image));
            }

            $imagePath = $request->file('image')->store('attractions', 'public');
            $validated['image'] = '/storage/' . $imagePath;
        } else {
            // Keep the old image path if no new image uploaded
            $validated['image'] = $attraction->image;
        }

        $attraction->update($validated);

        return redirect()->route('admin.attractions.index')
                        ->with('success', 'Attraction updated successfully');
    }

    public function destroy(Attraction $attraction)
    {
        // Delete image if exists
        if ($attraction->image && file_exists(public_path($attraction->image))) {
            unlink(public_path($attraction->image));
        }

        $attraction->delete();

        return redirect()->route('admin.attractions.index')
                         ->with('success', 'Attraction deleted');
    }
}
