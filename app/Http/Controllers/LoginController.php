<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Termwind\Components\Dd;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('authenticated')->only('logout', 'profile', 'update');
        $this->middleware('redirectIfLogged')->only('loginform', 'authenticate');
    }

    /**
     * Handle a login request to the application.
     */

    public function loginform()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if the email exists in the database
        $admin = User::where('email', $request->email)->first();

        if ($admin) {

            // Check if the password is correct (hashed)
            if (password_verify($request->password, $admin->password)) {

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
        // Remove the user from the session
        $request->session()->forget('user');

        // Redirect to the main page
        return redirect()->route('main');
    }

    /**
     * Handle a profile request to the application.
     */

    public function profile(Request $request)
    {
        $user = $request->session()->get('user');
        return view('auth.profile', ['user' => $user]);
    }

    /**
     * Handle an admin request to the application.
     */

    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    /**
     * Handle an update profile request to the application.
     */

    public function update(Request $request)
    {
        // Get the user from the session
        $user = User::find($request->session()->get('user')->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:1024', 'mimes:jpg,jpeg,png'],
        ]);

        if ($request->hasFile('image')) {
            // move the file to the public folder
            $image = $request->file('image');
            $image->store('public/profiles');

            // Delete the old profile picture
            if ($user->image) {
                unlink(storage_path('app/public/profiles/' . $user->image));
            }

            // Update the profile picture
            $user->image = $image->hashName();
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->birthdate = $validated['birthdate'];
        $user->save();

        // Update the user in the session
        $request->session()->put('user', $user);

        // Redirect to the main page
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
