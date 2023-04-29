<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;

use App\Http\Controllers\Crud\ExamController;
use App\Http\Controllers\Crud\UserController;
use App\Http\Controllers\Crud\PaymentController;
use App\Http\Controllers\Crud\VehicleController;

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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login-show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('update-profile');

// Dashboard
Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {
    Route::view('/', 'dashboard.index')->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('exams', ExamController::class);
    Route::post('/exams/addStudent', [ExamController::class, 'addStudent'])->name('exams.addStudent');
    Route::post('/exams/updateResult', [ExamController::class, 'updateResult'])->name('exams.updateResult');
    Route::post('/exams/removeStudent', [ExamController::class, 'removeStudent'])->name('exams.removeStudent');
    Route::resource('vehicles', VehicleController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('/payments/create/{user}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
});
