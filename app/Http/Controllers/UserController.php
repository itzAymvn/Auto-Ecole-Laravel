<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class UserController extends Controller
{

    /*
    * Middleware to protect routes.
    */

    public function __construct()
    {
        $this->middleware('loggedIn');
        $this->middleware('redirectIfNotAdmin')->only(['index', 'show', 'edit', 'update', 'destroy']);
    }



    /*
    * Display all users.
    */

    public function index()
    {
        $users = User::where('type', '!=', 'Admin')->paginate(5);
        return view('users.index', compact('users'));
    }

    /*
    * Display a user.
    * Display all sessions, exams and progress for a user (if any)
    */

    public function show(User $user)
    {
        // Paginate the sessions, exams and progress

        $sessions = $user->sessions;
        $exams = $user->exams;
        $progress = $user->progress;
        return view('users.show', compact('user', 'sessions', 'exams', 'progress'));
    }

    /*
    * Display a form to edit a user.
    */

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /*
    * Update a user.
    */

    public function update(User $user, Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required',
                'username' => 'required',
                'email' => 'required|email',
                'profile' => 'file|image|max:2000',
            ]
        );

        if ($request->hasFile('profile')) {
            // move the file to the public folder
            $profile = $request->file('profile');
            $profile->store('public/profiles');

            // Delete the old profile picture
            if ($user->profile) {
                unlink(storage_path('app/public/profiles/' . $user->profile));
            }

            // Update the profile picture
            $user->profile = $profile->hashName();
        }

        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('users.show', $user);
    }

    /*
    * Delete a user.
    */

    public function destroy(User $user)
    {

        // Delete the profile picture
        if ($user->profile) {
            unlink(storage_path('app/public/profiles/' . $user->profile));
        }

        $user->delete();

        return redirect()->route('users.index');
    }
}
