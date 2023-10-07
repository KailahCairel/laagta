<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Rules\CurrentPasswordCheck;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Your dashboard logic here

        return view('admin.index');
    }

    public function users() {
        $users = User::paginate(10);

        // Pass the user as data to the view
        return view('admin.users.index', ['users' => $users]);
    }

    public function profile()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Pass the user as data to the view
        return view('admin.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // dd($request);

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'string|max:255|unique:users,phone,' . $user->id,
            'job' => 'string|max:255', // Add validation rules for job
            'location' => 'string|max:255', // Add validation rules for location
            'description' => 'string', // Add validation rules for description
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

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
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

        return redirect()->route('admin.profile')->with('success', 'Password changed successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'status' => 'required|in:0,1', // Define the allowed statuses
        ]);

        // Update the user's status
        $user->update([
            'status' => $request->input('status'),
        ]);

        // Redirect back or return a response
        return redirect()->back()->with('success', 'User status updated successfully');
    }


    public function fetchUsers(Request $request)
    {
        // Get the status from the request query parameters
        $status = $request->query('status');

        // Query the database to fetch users based on the status
        $users = User::where('status', $status)->get();

        // You can return the filtered users as JSON or HTML, depending on your needs
        return view('users.index', compact('users')); // Assuming you have a users.index view
    }

}
