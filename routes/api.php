<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store');
    Route::patch('/hotels/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');
});
