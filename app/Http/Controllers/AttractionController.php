<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attraction;

class AttractionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $attractions = Attraction::query()
        ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%")
                                            ->orWhere('location', 'like', "%{$request->search}%"))
        ->get();


        return view('attractions.index', compact('attractions'));
    }

    public function show(Attraction $attraction)
    {
        return view('attractions.show', compact('attraction'));
    }
}
