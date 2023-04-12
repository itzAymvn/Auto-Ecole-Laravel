<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('redirectIfNotAdmin')->only('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
            'birthdate' => 'required',
            'password' => 'required|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Check if password and password_confirmation are the same
        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('error', 'Password and password confirmation are not the same');
        }

        // Create a new user object
        $user = new User();

        // Assign the values to the user object
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthdate = $request->birthdate;
        $user->password = bcrypt($request->password);

        // Check if the request has a file
        if ($request->hasFile('image')) {

            // Hash the image name and store it in the folder & update the user object
            $image = $request->image;
            $image->store('public/profiles');
            $user->image = $image->hashName();
        }

        // Save the user object with an error/success message
        if ($user->save()) {
            return redirect()->back()->with('success', 'User created successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
            'birthdate' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update the user object
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthdate = $request->birthdate;

        // Check if the request has a file
        if ($request->hasFile('image')) {

            // Delete the old image
            if ($user->image) {
                unlink(storage_path('app/public/profiles/' . $user->image));
            }

            // Hash the image name and store it in the folder & update the user object
            $image = $request->image;
            $image->store('public/profiles');
            $user->image = $image->hashName();
        }

        // Save the user object with an error/success message
        if ($user->save()) {
            return redirect()->back()->with('success', 'User updated successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the user object with an error/success message
        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('users.index')->with('error', 'Something went wrong');
        }
    }
}
