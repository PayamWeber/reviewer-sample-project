<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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

Route::post('/auth/login', [LoginController::class, 'login']);

Route::prefix('/product')->group(function () {
    Route::get('/list', [ProductController::class, 'list']);
});

Route::middleware('auth:sanctum')->prefix('/backoffice')->group(function () {
    Route::resource('/product', \App\Http\Controllers\BackOffice\ProductController::class)->except(['show', 'edit', 'create', 'delete']);
});

Route::middleware('auth:sanctum')->prefix('/review')->group(function () {
    Route::post('/submit', [ReviewController::class, 'submit']);
});
