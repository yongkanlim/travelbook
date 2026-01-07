<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;

class AttractionController extends Controller
{
    // Display data & (request) is used for search form
    public function index(Request $request)
    {
        // Reads ?search= from URL, /attractions?search=park
        $search = $request->query('search');

        // Starts a new query on the attractions table
        $attractions = Attraction::query()

        // What when() does
        // Runs the search only if search exists
        // Prevents unnecessary filtering when search is empty
        ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%")
                                            ->orWhere('location', 'like', "%{$request->search}%"))
        ->get();
        // ->get(); - Executes SQL query

        // Sends data to Blade view, compact() creates ['attractions' => $attractions]
        return view('attractions.index', compact('attractions'));
    }

    public function show(Attraction $attraction)
    {
        return view('attractions.show', compact('attraction'));
    }
}
