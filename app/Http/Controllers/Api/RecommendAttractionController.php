<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecommendAttraction;
use Illuminate\Http\Request;

class RecommendAttractionController extends Controller
{
    public function index()
    {
        return RecommendAttraction::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        return RecommendAttraction::create($data);
    }

    public function show($id)
    {
        return RecommendAttraction::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $attraction = RecommendAttraction::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'location' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|string',
            'rating' => 'sometimes|numeric|min:0|max:5',
        ]);

        $attraction->update($data);
        return $attraction;
    }

    public function destroy($id)
    {
        RecommendAttraction::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
