<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ExamController;

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
Route::get('/login', [LoginController::class, 'loginform'])->name('login-form'); # Route to the login form
Route::post('/login', [LoginController::class, 'authenticate'])->name('login'); # Route to actually log in
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); # Route to log out
Route::get('/profile', [LoginController::class, 'profile'])->name('profile'); # Route to the profile page
Route::get('/admin', [LoginController::class, 'admin'])->name('admin'); # Route to the admin page (only accessible if logged in as admin)

Route::resource('users', UserController::class);
