<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('authenticated')->only('logout', 'profile', 'update');
        $this->middleware('redirectIfLogged')->only('show', 'login');
    }

    /**
     * Handle a login request to the application.
     */

    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $request->session()->put('user', $user);
                return redirect()->route('main');
            } else {
                return redirect()->route('login')->withInput()->withErrors(['password' => 'Did you forget your password?']);
            }
        } else {
            return redirect()->route('login')->withInput()->withErrors(['email' => 'This email does not exist in our database']);
        }
    }

    /**
     * Handle a logout request to the application.
     */

    public function logout(Request $request)
    {
        $request->session()->forget('user');
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
