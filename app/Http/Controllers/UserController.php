<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Rules\CurrentPasswordCheck;
use Illuminate\Support\Str;

use App\Models\Destination;
use App\Models\Establishment;

class UserController extends Controller
{
    public function dashboard()
    {
        // Your dashboard logic here
        $destinations = Destination::where('status', '1')->get();
        $establishments = Establishment::where('status', '1')->get(); 

        return view('users.index', compact('destinations', 'establishments'));
    }

    public function establishment(string $id)
    {
        // Your dashboard logic here
        $establishment  = Establishment::findOrFail($id);

        return view('users.establishment', compact('establishment'));
    }

    public function profile()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Pass the user as data to the view
        return view('users.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
            'job' => 'required|string|max:255', // Add validation rules for job
            'location' => 'required|string|max:255', // Add validation rules for location
            'description' => 'required|string', // Add validation rules for description
            // Add validation rules for other fields
        ]);

        // Update user data
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->job = $request->input('job');
        $user->location = $request->input('location');
        $user->description = $request->input('description');
        // Update other fields as needed

        // Handle the profile image update
        if ($request->hasFile('profile_image')) {
            // Delete the old profile image if it exists
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Upload the new profile image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        // Save the updated user data
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', new CurrentPasswordCheck],
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->route('user.profile')->with('error', 'Current password is incorrect');
        }

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Password changed successfully');
    }

    public function processForm(Request $request)
    {
        $destinationId = $request->input('location');
        $categories = $request->input('categories');
        $adults = $request->input('adults');
        $children = $request->input('childs');
        $budget = $request->input('budget');

        // Initialize $numberofdays to null
        $numberofdays = null;

        // Check if 'categories' is 'accommodation' to retrieve 'numberofdays'
        if ($categories === 'accommodation') {
            $numberofdays = $request->input('numberofdays');
        }

        // Initialize the $arr with an empty array
        $arr = [];

        // Use a switch statement to conditionally add filters based on $categories
        switch ($categories) {
            case 'accommodation':
                $arr['has_accomodation'] = 1;
                break;

            case 'rides':
                $arr['has_rides'] = 1;
                break;

            case 'venues':
                $arr['has_venues'] = 1;
                break;

            default:
                break;
        }
   

        // Query establishments based on criteria
        $establishments = Establishment::where('status', 1)
            ->where('destination_id', $destinationId)
            ->where($arr)
            ->get();

        $destination = Destination::findOrFail($destinationId);


        // Pass the variables to the 'users.suggestion' view
        return view('users.suggestion', compact('destination', 'categories', 'numberofdays', 'adults', 'children', 'budget', 'establishments'));
    }
}
