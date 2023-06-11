<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $staff = User::where('type', 'instructor')->orWhere('type', 'admin')->get();

        return view('main', compact('staff'));
    }
}
