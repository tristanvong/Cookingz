<?php

namespace App\Http\Controllers;

use App\Models\FoodType;
use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    public function create()
    {
        return view('foodtype.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        FoodType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('foodtypes.index')->with('success', 'Food Type created successfully');
    }

    public function index()
    {
        $foodTypes = FoodType::all();
        return view('foodtype.index', compact('foodTypes'));
    }

    public function edit(Request $request)
    {
        $foodType = FoodType::find($request->id);
        return view('foodtype.edit', compact('foodType', 'foodType'));
    }

    public function destroy(Request $request)
    {
        FoodType::destroy($request->id);
        return redirect()->route('foodtypes.index')->with('success', 'Food Type deleted successfully');
    }
}
