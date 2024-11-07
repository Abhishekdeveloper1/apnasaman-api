<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('register', [UserController::class, 'register'])->name('register');

// Authenticated Routes (Requires Bearer Token)
Route::middleware('auth:api')->group(function () {
    Route::post('userinfo', [UserController::class, 'userinfo'])->name('userinfo');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});
// Route::post('userinfo', [UserController::class, 'userinfo'])->name('userinfo');
