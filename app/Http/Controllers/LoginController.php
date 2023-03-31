<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('redirectIfLogged')->only('loginform');
        $this->middleware('redirectIfNotAdmin')->only('admin');
    }

    /**
     * Handle a login request to the application.
     */

    public function loginform()
    {
        return view('login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        // Check if user is already logged in
        if (session()->has('user')) {
            return redirect()->route('main');
        }

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if the email exists in the database
        $admin = User::where('email', $request->email)->first();

        if ($admin) {

            // Check if the password is correct
            if ($request->password == $admin->password) {

                // save the user in the session
                $request->session()->put('user', $admin);

                // Redirect to the main page
                return redirect()->route('main');
            } else {

                // Redirect back to the login page with an error message
                return redirect()->route('login-form')->withInput()->withErrors(['password' => 'Did you forget your password?']);
            }
        } else {

            // Redirect back to the login page with an error message
            return redirect()->route('login-form')->withInput()->withErrors(['email' => 'This email does not exist in our database']);
        }
    }

    /**
     * Handle a logout request to the application.
     */

    public function logout(Request $request)
    {
        if (session()->has('user')) {
            // Remove the user from the session
            $request->session()->forget('user');
        }


        // Redirect to the main page
        return redirect()->route('main');
    }

    /**
     * Handle a profile request to the application.
     */

    public function profile(Request $request)
    {
        if (session()->has('user')) {
            // Get the user from the session
            $user = $request->session()->get('user');
            return view('profile', ['user' => $user]);
        } else {
            // Redirect to the main page
            return redirect()->route('main');
        }
    }

    /**
     * Handle an admin request to the application.
     */

    public function admin(Request $request)
    {
        if (session()->has('user')) {
            // Get the user from the session
            $user = $request->session()->get('user');
            if ($user->type == 'Admin') {
                return view('admin.dashboard');
            } else {
                // Redirect to the main page
                return redirect()->route('main');
            }
        } else {
            // Redirect to the main page
            return redirect()->route('main');
        }
    }
}
