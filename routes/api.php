<?php

use Illuminate\Http\Request;
use App\Models\Material;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/firebase-login', 'loginWithFirebase');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::get('/materials', function () {
    return Material::orderBy('order')
        ->select('id', 'name', 'slug', 'short_description', 'image_url')
        ->get();
});
Route::get('/materials/{slug}', function ($slug) {
    return Material::where('slug', $slug)->firstOrFail();
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
