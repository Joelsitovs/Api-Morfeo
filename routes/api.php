<?php

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Session;


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/firebase-login', 'loginWithFirebase');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    $user->roles = $user->getRoleNames();
    return $user;
});
Route::middleware('auth:sanctum')->get('/test', function () {
    return response()->json(['message' => 'ola']);
});
Route::get('/debug-test', function () {
    return response()->json(['message' => '¡Llega!']);
});
