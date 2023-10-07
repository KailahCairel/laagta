<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        // Retrieve destinations from the database
        $destinations = Destination::all();

        // Pass the destinations data to the view
        return view('admin.destinations.index', ['destinations' => $destinations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create a new empty destination instance
        $destination = new Destination();

        return view('admin.destinations.create', compact('destination'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Check if the status checkbox is checked in the request
        $status = $request->has('status') ? 1 : 0;

        // Create a new destination
        Destination::create(array_merge(
            $request->all(), 
            [
                'status' => $status, 
                'description' => $request->input('description'),
            ]
        ));

        // Redirect to the destinations index page
        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         // Retrieve the specific destination based on the provided $id
        $destination = Destination::findOrFail($id);

        // Pass the destination data to the view
        return view('admin.destinations.edit', ['destination' => $destination]);
    }

    public function edit(string $id)
    {
        // Retrieve the specific destination based on the provided $id
        $destination = Destination::findOrFail($id);

        // Return the edit form view with the destination data
        return view('admin.destinations.edit', ['destination' => $destination]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255', 
        ]);

        // Check if the status checkbox is checked in the request
        $status = $request->has('status') ? 1 : 0;

        // Find the destination by ID
        $destination = Destination::findOrFail($id);

        // Update the destination with the new data, including the status
        $destination->update(array_merge(
            $request->all(), 
            [
                'status' => $status, 
                'description' => $request->input('description'), 
                'location' => $request->input('location')
            ]
        ));

        // Redirect to the destinations index page
        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the destination by ID
        $destination = Destination::findOrFail($id);

        // Delete the destination
        $destination->delete();

        // Redirect to the destinations index page
        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully');
    }
 
}
