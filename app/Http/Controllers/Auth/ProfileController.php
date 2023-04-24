<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();

        return view('auth.profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {

        $user = User::find(Auth::id());
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:5000', 'mimes:jpg,jpeg,png'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/profiles');
            if ($user->image) {
                unlink(storage_path('app/public/profiles/' . $user->image));
            }
            $user->image = $image->hashName();
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->birthdate = $validated['birthdate'];
        if ($user->save()) {
            return redirect()->route('profile')->with('success', 'Votre profil a été mis à jour avec succès.');
        } else {
            return redirect()->route('profile')->with('error', 'Une erreur est survenue lors de la mise à jour de votre profil.');
        }
    }
}
