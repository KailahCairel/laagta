<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'establishment_id' => 'required|exists:establishments,id',
            'price' => 'required|numeric', // Add validation for the 'price' field
        ]);

        Room::create($validatedData);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }
}
