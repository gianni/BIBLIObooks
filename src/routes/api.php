<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReservationsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(BooksController::class)->group(function () {
    Route::get('books', 'index');
    Route::get('books/{id}', 'show');
    Route::post('books', 'store');
    Route::put('books/{id}', 'update');
    Route::delete('books/{id}', 'delete');
});

Route::controller(ReservationsController::class)->group(function () {
    Route::get('reservations', 'index');
    Route::post('reservations', 'store');
});
