<?php

namespace App\Http\Controllers\Crud;

use App\Models\User;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all()->groupBy('user_id');
        return view('crud.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        return view('crud.payments.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'goal_amount' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'amount_paid' => 'required|numeric',
        ]);

        $payment = new Payment();
        $payment->user_id = $validated['user_id'];
        $payment->goal_amount = $validated['goal_amount'];
        $payment->amount_paid = $validated['amount_paid'];

        $payment->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $user = $payment->user;
        $payments = $user->payments;
        return view('crud.payments.show', compact('user', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
