<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\StatisticsController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;

use App\Http\Controllers\Crud\UserController;
use App\Http\Controllers\Crud\VehicleController;
use App\Http\Controllers\Crud\PaymentController;
use App\Http\Controllers\Crud\SpendingController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login-show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('update-profile');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('update-password');

// Dashboard
Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {
    Route::redirect('/', '/dashboard/users', 301)->name('dashboard');

    Route::resource('users', UserController::class);

    Route::resource('exams', ExamController::class);
    Route::post('/exams/add-student', [ExamController::class, 'addStudent'])->name('exams.addStudent');
    Route::post('/exams/update-result', [ExamController::class, 'updateResult'])->name('exams.updateResult');
    Route::post('/exams/remove-student', [ExamController::class, 'removeStudent'])->name('exams.removeStudent');

    Route::resource('vehicles', VehicleController::class);

    Route::resource('payments', PaymentController::class);
    Route::get('/payments/create/{user}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');

    Route::get("statistics", [StatisticsController::class, 'index'])->name('statistics.index');

    Route::resource('spendings', SpendingController::class);
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
