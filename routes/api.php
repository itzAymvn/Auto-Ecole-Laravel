<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/users', function (Request $request) {
    $users =
        User::get(['id', 'name', 'email', 'phone', 'type', 'address', 'birthdate', 'created_at'])->Where('type', '==', 'student');

    if ($users->count() > 0) {
        return $users;
    } else {
        return response()->json([
            'message' => 'Aucun utilisateur trouvé.'
        ], 404);
    }
});

Route::get('/users/{id}', function (Request $request, $id) {
    $user =
        User::get(['id', 'name', 'email', 'phone', 'type', 'address', 'birthdate', 'created_at'])->Where('type', '==', 'student')->Where('id', '==', $id);

    if ($user->count() > 0) {
        return $user;
    } else {
        return response()->json([
            'message' => 'Aucun utilisateur trouvé.'
        ], 404);
    }
});

Route::get('/users/{id}/exams', function (Request $request, $id) {
    $exams = User::find($id)->exams;
    if ($exams->count() > 0) {
        return $exams;
    } else {
        return response()->json([
            'message' => 'Aucun examen trouvé pour cet utilisateur.'
        ], 404);
    }
});

Route::get('/users/{id}/payments', function (Request $request, $id) {
    $payments = User::find($id)->payments;
    if ($payments->count() > 0) {
        return $payments;
    } else {
        return response()->json([
            'message' => 'Aucun paiement trouvé pour cet utilisateur.'
        ], 404);
    }
});

Route::get('/users/{id}/spendings', function (Request $request, $id) {
    $spendings = User::find($id)->spendings;
    if ($spendings->count() > 0) {
        return $spendings;
    } else {
        return response()->json([
            'message' => 'Aucune dépense trouvée pour cet utilisateur.'
        ], 404);
    }
});
