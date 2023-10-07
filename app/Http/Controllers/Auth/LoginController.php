<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // Add this line

use App\Rules\ActiveUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }

        if ($user->hasRole('user')) {
            return redirect('/user/dashboard');
        }

        // Default redirection if the user doesn't have a recognized role
        return redirect('/home');
    }

    protected function attemptLogin(Request $request)
    {
        // Check if the user is attempting to log in
        // Only allow users with status = 1 (active) to log in
        return Auth::attempt(
            $this->credentials($request) + ['status' => 1], // Add the status check
            $request->filled('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
            'status' => [trans('auth.inactive')],
        ]);
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => 1, // Only allow login if the status is active (status = 1)
        ];
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ['required', 'string', 'email', new ActiveUser],
            'password' => ['required', 'string'],
        ]);
    }

}
