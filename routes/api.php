<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('/user', function () {
    // ...
})->middleware('auth:api');
Route::post('login', 'App\Http\Controllers\Api\UserController@login')->name('login');
Route::post('register', 'App\Http\Controllers\Api\UserController@register')->name('register');


Route::middleware('auth:api')->group(function () {
    Route::post('userinfo',[UserController::class,'userinfo']);
    Route::post('logout',[UserController::class,'logout']);
});


