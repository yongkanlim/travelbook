<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
class DestinationController extends Controller
{
    // Display data & (request) is used for search form
   public function index(Request $request) {
    
    // $destinations = Destination::all(); // Used to display data (no use)

    // ==================================================================================================================
    // Only query destinations that have at least 1 available room
    // ==================================================================================================================
    $query = Destination::where('available_rooms', '>', 0);

    // --------------------------------------------------------------------------------------------------------------------------------
    // $request->has('search') → checks if the search input exists in the request (e.g., the search form inside destination.index.php).
    // !empty($request->search) → ensures the input is not empty.
    // $search = $request->search; → stores the search term to use in the query.
    // ---------------------------------------------------------------------------------------------------------------------------------
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;

    // --------------------------------------------------------------------------------------------------------------------------------
    // $query->where(function($q) use ($search) { ... }); → wraps multiple conditions in parentheses.
    // --------------------------------------------------------------------------------------------------------------------------------
    // Inside the closure:
    // $q->where('name', 'like', "%{$search}%") → selects destinations where the name contains the search term.
    // orWhere('location', 'like', "%{$search}%") → or the location contains the search term.
    // --------------------------------------------------------------------------------------------------------------------------------
    // The % symbols in "%{$search}%" are wildcards in SQL:
    // %Kuala% matches anything containing "Kuala" (like "Kuala Lumpur").
    // Effect: This allows a user to search by name or location.
    // --------------------------------------------------------------------------------------------------------------------------------
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }
  
    // Runs the SQL query in the database.
    $destinations = $query->get();

        // Only get destinations with available rooms > 0 (no work with search function)
    // $destinations = \App\Models\Destination::where('available_rooms', '>', 0)->get();

    // ==================================================================================================================
    // compact() - PHP function that converts variables into an associative array for passing to the view.
    // ==================================================================================================================
    // compact('destinations') is same with ['destinations' => $destinations]
    // ==================================================================================================================
    return view('destinations.index', compact('destinations'));

    }

    public function create() {
    return view('destinations.create');
    }

    // ===================================================================================================================
    // Store Method (Save New Destination)
    // ===================================================================================================================
    // Saves a new destination to the database using the request data.
    // Destination::create() requires that the Destination model has $fillable properties defined to allow mass assignment.
    // Redirects back to the list page after saving.
    // ===================================================================================================================
    public function store(Request $request) {
    Destination::create($request->all());
    return redirect()->route('destinations.index');
    }

    // Shows a single destination's details.
    // Laravel automatically resolves the $destination by its ID from the route parameter (Route Model Binding).
    public function show(Destination $destination) {
    return view('destinations.show', compact('destination'));
    }

    // Returns a form pre-filled with the destination data for editing.
    public function edit(Destination $destination) {
    return view('destinations.edit', compact('destination'));
    }

    // Updates the existing destination with the new form data.
    // Uses mass assignment, so $fillable must be defined in the model.
    // Redirects back to the list page after updating.
    public function update(Request $request, Destination $destination) {
    $destination->update($request->all());
    return redirect()->route('destinations.index');
    }

    // Deletes a destination from the database.
    // Redirects to the index page afterward.
    public function destroy(Destination $destination) {
    $destination->delete();
    return redirect()->route('destinations.index');
    }
}
