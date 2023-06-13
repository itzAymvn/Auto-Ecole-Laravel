<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;

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
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('main');
        }

        // Determine whether the email or password is incorrect
        $errors = [];
        if (!User::where('email', $request->email)->first()) {
            $errors['email'] = Lang::get('auth.email');
        } else {
            $errors['password'] = Lang::get('auth.password');
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

    // Show password reset form
    public function showPasswordResetForm()
    {
        return view('auth.password_reset');
    }

    // Send password reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($request->only('email'));

        // redirect to login page with status


        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => Lang::get('auth.sent')])
            : back()->withErrors(['email' => trans($status)]);
    }


    // Show password reset form with token
    public function showResetForm(Request $request, $token)
    {
        $email = $request->email;

        // Token from hashed token from database
        $tokenFromDatabase = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if ($tokenFromDatabase) {
            $dbToken = $tokenFromDatabase->token;
        } else {
            abort(404);
        }

        // Hash the token from request and compare it with the token from database
        if (!Hash::check($token, $dbToken)) {
            abort(404);
        }

        // if token is valid, show reset password form
        return view('auth.reset_password', ['token' => $token, 'email' => $request->email]);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', Lang::get('auth.reset'))
            : back()->withErrors(['email' => trans($status)]);
    }
}
