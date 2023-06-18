<?php

namespace App\Http\Controllers\Crud;

use Carbon\Carbon;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $this->authorize('view-users');

        $query = User::query();

        if (request()->has('search') && request()->input('search') != '') {
            $search = request()->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        if (request()->has('type') && request()->input('type') != '') {
            $type = request()->input('type');
            $query->where('type', $type);
        }

        if (request()->has('period') && request()->input('period') != '') {
            $period = request()->input('period');
            $now = Carbon::now();

            if ($period == 'today') {
                $query->whereDate('created_at', $now->toDateString());
            } elseif ($period == 'week') {
                $startOfWeek = $now->startOfWeek()->toDateString();
                $endOfWeek = $now->endOfWeek()->toDateString();
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            } elseif ($period == 'month') {
                $query->whereMonth('created_at', $now->month);
            } elseif ($period == 'year') {
                $query->whereYear('created_at', $now->year);
            }
        }

        if (request()->has('month') && request()->input('month') != '') {
            $month = request()->input('month');
            $query->whereMonth('created_at', $month);
        }

        if (request()->has('year') && request()->input('year') != '') {
            $year = request()->input('year');
            $query->whereYear('created_at', $year);
        }

        $users = $query->paginate(7);
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-users');
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create-users');

        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'type' => 'required|in:admin,instructor,student',
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
        $user->type = $request->type;
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
            return redirect()->back()->with('success', 'L\'utilisateur a été ajouté avec succès');
        } else {
            return redirect()->back()->with('error', 'Quelque chose s\'est mal passé, veuillez réessayer');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view-users');

        if ($user->id == Auth::user()->id) {
            return redirect()->route('profile');
        } else {
            return view('dashboard.users.show', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('edit-users');

        if ($user->id == Auth::user()->id) {
            return redirect()->route('profile');
        } else {
            return view('dashboard.users.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit-users');

        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
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
                if (file_exists(storage_path('app/public/profiles/' . $user->image))) {
                    unlink(storage_path('app/public/profiles/' . $user->image));
                }
            }

            // Hash the image name and store it in the folder & update the user object
            $image = $request->image;
            $image->store('public/profiles');
            $user->image = $image->hashName();
        }


        // Save the user object with an error/success message
        if ($user->save()) {
            // update the session
            return redirect()->back()->with('success', 'L\'utilisateur a été modifié avec succès');
        } else {
            dd($user->errors);
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->authorize('edit-users');

        // Validate the request
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        // Check if password and password_confirmation are the same
        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('error', 'Password and password confirmation are not the same');
        }

        // Update the user object
        $user->password = bcrypt($request->password);

        // Save the user object with an error/success message
        if ($user->save()) {
            return redirect()->back()->with('success', 'Le mot de passe a été modifié avec succès');
        } else {
            return redirect()->back()->with('error', 'Quelque chose s\'est mal passé, veuillez réessayer');
        }
    }

    /**
     * Delete the user from the database
     */
    public function destroy(User $user)
    {
        $this->authorize('delete-users');

        // If the user has an image, delete it
        if ($user->image) {
            if (file_exists(storage_path('app/public/profiles/' . $user->image))) {
                unlink(storage_path('app/public/profiles/' . $user->image));
            }
        }
        // Delete the user object with an error/success message
        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', 'L\'utilisateur a été supprimé avec succès');
        } else {
            return redirect()->route('users.index')->with('error', 'Quelque chose s\'est mal passé');
        }
    }

    /**
     * Show the dashboard page
     */

    public function dashboard()
    {
        $user_type = Auth::user()->type;

        switch ($user_type) {
            case 'admin':
                return redirect()->route('users.index');
                break;
            case 'instructor':
                return redirect()->route('sessions.index');
                break;
            case 'student':
                return abort(403);
                break;
            default:
                return redirect()->route('login');
                break;
        }
    }
}
