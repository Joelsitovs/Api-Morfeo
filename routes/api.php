<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Material;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebhookController;


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


Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->put('/users/{id}', [UserController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/users/{id}', [UserController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/test', function () {
    return response()->json(['message' => 'ola']);
});
Route::get('/debug-test', function () {
    return response()->json(['message' => '¡Llega!']);
});


Route::post('/webhook', [WebhookController::class, 'handle']);

Route::middleware('auth:sanctum')->get('/orders', [OrderController::class, 'index']);


Route::get('/materials', function () {
    return Material::orderBy('order')
        ->select('id', 'name', 'slug', 'short_description', 'image_url', 'price')
        ->get();
});
Route::get('/materials/{slug}', function ($slug) {
    return Material::where('slug', $slug)->firstOrFail();
});

