<?php

namespace App\Http\Controllers\Crud;

use App\Models\User;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* 
            SELECT u.name AS user_name, p.goal_amount, SUM(p.amount_paid) AS total_paid, goal_amount - SUM(p.amount_paid) as remaining_amount
            FROM users u
            inner JOIN payments p 
            ON u.id = p.student_id
            GROUP BY u.id
        */

        $payments = Payment::select(
            'users.id as user_id',
            'users.name AS user_name',
            'payments.goal_amount',
            DB::raw('SUM(payments.amount_paid) AS total_paid'),
            DB::raw('payments.goal_amount - SUM(payments.amount_paid) as remaining_amount')
        )
            ->join(
                'users',
                'users.id',
                '=',
                'payments.student_id'
            )
            ->groupBy('users.id')
            ->get();

        return view('dashboard.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $total_paid = $user->payments->sum('amount_paid') ?? null;
        $goal_amount = $user->payments->last()->goal_amount ?? null;
        $remaining_amount = $user->payments->last()->remaining_amount ?? null;
        return view('dashboard.payments.create', compact('user', 'total_paid', 'goal_amount', 'remaining_amount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'goal_amount' => 'required|numeric',
            'student_id' => 'required|exists:users,id',
            'amount_paid' => 'required|numeric',
        ]);

        $payment = new Payment();
        $payment->student_id = $validated['student_id'];
        $payment->goal_amount = $validated['goal_amount'];
        $payment->amount_paid = $validated['amount_paid'];

        if ($payment->save()) {
            return redirect()->route('payments.show', $validated['student_id'])->with('success', 'Payment added successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $user = User::findOrFail($student_id);
        $payments = $user->payments;

        return view('dashboard.payments.show', compact('user', 'payments'));
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
        if ($payment->delete()) {
            return redirect()->back()->with('success', 'Payment deleted successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }
}
