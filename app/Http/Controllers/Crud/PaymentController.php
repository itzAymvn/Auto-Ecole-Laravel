<?php

namespace App\Http\Controllers\Crud;

use App\Models\User;
use App\Models\Payment;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view-payments');

        $query = Payment::query();

        $payments = Payment::select(
            'users.id as user_id',
            'users.name AS user_name',
            DB::raw(
                '(SELECT goal_amount
                FROM payments p2
                WHERE p2.student_id = payments.student_id
                ORDER BY created_at DESC LIMIT 1) AS goal_amount'
            ),
            DB::raw('SUM(payments.amount_paid) AS total_paid'),
            DB::raw(
                '(SELECT goal_amount
                FROM payments p2
                WHERE p2.student_id = payments.student_id
                ORDER BY created_at DESC LIMIT 1) - SUM(payments.amount_paid) as remaining_amount'
            )
        )
            ->join(
                'users',
                'users.id',
                '=',
                'payments.student_id'
            )
            ->groupBy('users.id')
            ->get();

        if ($request->query('search')) {
            $search = $request->query('search');
            $payments = $payments->filter(function ($payment) use ($search) {
                return stripos($payment->user_name, $search) !== false;
            });
        }

        if ($request->query('status')) {
            $status = $request->query('status');
            if ($status == 'finished') {
                $payments = $payments->filter(function ($payment) {
                    return $payment->remaining_amount == 0;
                });
            } elseif ($status == 'in_progress') {
                $payments = $payments->filter(function ($payment) {
                    return $payment->remaining_amount > 0;
                });
            }
        }

        return view('dashboard.payments.index', compact('payments'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-payments');

        if (request()->query('user_id')) {
            $user = User::findOrFail(request()->query('user_id'));

            if ($user->type != 'student') {
                return redirect()->route('payments.index')->with('error', 'Vous ne pouvez pas ajouter un paiement à un utilisateur qui n\'est pas un étudiant');
            }
        } else {
            return redirect()->route('payments.index')->with('error', 'Vous devez sélectionner un étudiant. Depuis la liste des étudiant, cliquez sur le bouton "Ajouter un paiement"');
        }

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
        $this->authorize('create-payments');

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
            return redirect()->route('payments.show', $validated['student_id'])->with('success', 'Le paiement a été ajouté avec succès');
        }
        return redirect()->back()->with('error', 'Quelque chose s\'est mal passé');
    }

    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $this->authorize('view-payments');

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

        $this->authorize('delete-payments');

        if ($payment->delete()) {
            return redirect()->back()->with('success', 'Le paiement a été supprimé avec succès');
        }
        return redirect()->back()->with('error', 'Quelque chose s\'est mal passé');
    }

    public function paymentsPdf(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $payments = $user->payments;
        $pdf = PDF::loadView('dashboard.payments.paymentspdf', compact('user', 'payments'));
        $filename = 'payments_' . $user->name . '.pdf';
        return $pdf->download($filename);
    }
}
