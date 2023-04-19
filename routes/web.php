<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Crud\UserController;
use App\Http\Controllers\Crud\ExamController;

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

Route::view('/', 'main')->name('main');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
Route::post('/profile', [LoginController::class, 'update'])->name('update-profile');

// Dashboard
Route::prefix('dashboard')->middleware(['authenticated', 'admin'])->group(function () {
    Route::get('/', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('exams', ExamController::class);
});
