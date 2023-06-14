<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Spending;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view-statistics');

        $users = $this->getUsers();
        $payments = $this->getPayments($request);
        $charges = $this->getCharges($request);
        $salary = $this->getSalary($request);

        $earnings = $payments[0]->sum - ($charges[0]->sum + $salary[0]->sum);
        return view('dashboard.statistics.index', compact('users', 'payments', 'charges', 'salary', 'earnings'));
    }

    public function getUsers()
    {
        $users = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        return $users;
    }

    public function getPayments($request)
    {
        $query = Payment::query();

        if ($request->has('month') && $request->month != 'all') {
            $query->whereMonth('created_at', $request->month)->whereYear('created_at', date('Y'));
        }

        if ($request->has('year') && $request->year != 'all') {
            $query->whereYear('created_at', $request->year);
        }

        // calc sum of 'amount_paid' column
        $payments = $query->selectRaw('SUM(amount_paid) as sum')->get(); // [{"sum": 1000}}]

        return $payments;
    }

    public function getCharges($request)
    {
        $query = Spending::query();

        if ($request->has('month') && $request->month != 'all') {
            $query->whereMonth('created_at', $request->month)->whereYear('created_at', date('Y'));
        }

        if ($request->has('year') && $request->year != 'all') {
            $query->whereYear('created_at', $request->year);
        }

        // calc sum of 'amount' column where 'type' is not 'payment'
        $charges = $query->where('type', '!=', 'salary')->selectRaw('SUM(amount) as sum')->get();

        return $charges;
    }

    public function getSalary($request)
    {
        $query = Spending::query();

        if ($request->has('month') && $request->month != 'all') {
            $query->whereMonth('created_at', $request->month)->whereYear('created_at', date('Y'));
        }

        if ($request->has('year') && $request->year != 'all') {
            $query->whereYear('created_at', $request->year);
        }

        // calc sum of 'amount_paid' column where 'type' is 'salary'
        $salary = $query->where('type', 'salary')->selectRaw('SUM(amount) as sum')->get();

        return $salary;
    }
}
