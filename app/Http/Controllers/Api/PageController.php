<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecommendAttraction;

class PageController extends Controller
{
    public function index()
    {
        $attractions = RecommendAttraction::all();
        return view('api.index', compact('attractions'));
    }
}
