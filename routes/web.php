<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\VehicleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main page
Route::view('/', 'main')->name('main');

// Login Form
Route::get('/login', [LoginController::class, 'loginform'])->name('login-form');

// Authentication
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Profile page
Route::get('/profile', [LoginController::class, 'profile'])->name('profile');

// Update profile
Route::post('/profile', [LoginController::class, 'update'])->name('update-profile');


// Dashboard (only accessible if logged in as admin)
Route::prefix('dashboard')->middleware(['authenticated', 'admin'])->group(function () {
    // Dashboard: /dashboard
    Route::get('/', [LoginController::class, 'dashboard'])->name('dashboard');

    // Users: /dashboard/users
    Route::resource('users', UserController::class);
});
