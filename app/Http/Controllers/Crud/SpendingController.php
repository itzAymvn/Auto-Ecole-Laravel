<?php

namespace App\Http\Controllers\Crud;

use App\Models\User;

use App\Models\Spending;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spendings = Spending::all();
        return view('dashboard.spendings.index', compact('spendings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('type', '!=', 'student')->get();
        // check if there is a user_id in the request
        // if there is, then we are creating a payment for a specific user

        if (request()->has('user_id')) {
            $user = User::findOrFail(request()->user_id);

            // Make sure the user exists and is not a student
            if ($user->type !== 'student') {
                return view('dashboard.spendings.create', compact('user', 'users'));
            } else {
                return redirect()->route('users.show', $user->id)->with('error', 'Vous ne pouvez pas créer de dépense pour un élève.');
            }
        }

        return view('dashboard.spendings.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $spending = new Spending();

        // Validate the request
        $request->validate([
            'type' => 'required|in:payment,other',
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Create the spending
        $spending->type = $request->type;
        if ($request->type === 'payment') {
            $spending->user_id = $request->user_id;
        }
        $spending->amount = $request->amount;
        $spending->description = $request->description;

        if ($spending->save()) {
            return redirect()->route('spendings.index')->with('success', 'Dépense créée avec succès.');
        } else {
            return redirect()->route('spendings.index')->with('error', 'Une erreur est survenue lors de la création de la dépense.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Spending $spending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spending $spending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spending $spending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spending $spending)
    {
        //
    }
}
