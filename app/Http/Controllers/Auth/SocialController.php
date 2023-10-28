<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
     

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        // Check if the user is already registered in your application
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            // Log in the existing user
            auth()->login($existingUser);
        } else {
            // Create a new user in your application
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->save();


            $newUser  ->roles()->attach($userRole);

            // Log in the new user
            auth()->login($newUser);
        }

        // Redirect the user to a dashboard or profile page
        return redirect('/user/dashboard');
    }
}
