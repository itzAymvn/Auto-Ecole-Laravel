<?php

namespace App\Http\Controllers\Crud;

use App\Models\User;

use App\Models\Spending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-spendings');

        $query = Spending::query();

        if (request()->has('user_id')) {
            $userId = request()->input('user_id');
            $query->where('user_id', $userId);
        }

        if (request()->has('type') && request()->input('type') != '') {
            $paymentType = request()->input('type');
            $query->where('type', $paymentType);
        }

        if (request()->has('user_name') && request()->input('user_name') != '') {
            $userName = request()->input('user_name');
            $query->whereHas('user', function ($q) use ($userName) {
                $q->where('name', 'like', '%' . $userName . '%');
            });
        }

        if (request()->has('sort_by_date') && request()->input('sort_by_date') != '') {
            $sortByDate = request()->input('sort_by_date');
            if ($sortByDate == 'desc') {
                $query->orderByDesc('created_at');
            } elseif ($sortByDate == 'asc') {
                $query->orderBy('created_at');
            }
        }

        if (request()->has('date') && request()->input('date') != '') {
            $date = request()->input('date');
            $query->whereDate('created_at', $date);
        }


        $spendings = $query->get();

        return view('dashboard.spendings.index', compact('spendings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->authorize('create-spendings');

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
        $this->authorize('create-spendings');

        $spending = new Spending();

        // Validate the request
        $request->validate([
            'type' => 'required|in:salary,other',
            'amount' => 'required|numeric',
            'user_id' => 'required_if:type,payment|exists:users,id',
            'description' => 'nullable',
        ]);

        // Create the spending
        $spending->type = $request->type;
        if ($request->type === 'salary') {
            $spending->user_id = $request->user_id;
        }
        $spending->amount = $request->amount;

        if ($request->description == null) {
            $spending->description = 'Aucune description';
        } else {
            $spending->description = $request->description;
        }
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
