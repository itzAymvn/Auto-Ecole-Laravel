<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('redirectIfLogged')->except('logout');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('main');
        }

        // Determine whether the email or password is incorrect
        $errors = [];
        if (!User::where('email', $request->email)->first()) {
            $errors['email'] = 'The provided email is incorrect.';
        } else {
            $errors['password'] = 'The provided password is incorrect.';
        }

        return back()->withErrors($errors)->withInput();
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
