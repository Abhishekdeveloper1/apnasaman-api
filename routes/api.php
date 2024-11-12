<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductSubCategoryController;
use App\Http\Controllers\Api\ProductController;


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
// Route::get('categories', [CategoryController::class, 'index'])->name('allCategoryList');
Route::get('allCategoryList', [ProductCategoryController::class, 'index'])->name('allCategoryList.index');
Route::get('getCategoriesWithSubcategories', [ProductCategoryController::class, 'getCategoriesWithSubcategories'])->name('getCategoriesWithSubcategories');
Route::get('allSubCategoryList', [ProductSubCategoryController::class, 'index'])->name('allSubCategoryList.index');
Route::get('productsList/{id}', [ProductController::class, 'index'])->name('productsList.index');

