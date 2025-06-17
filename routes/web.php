<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::view('', 'landing')->name('landing');

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth')->name('auth');
    Route::post('login', [AuthenticationController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::delete('logout', [AuthenticationController::class, 'destroy'])->name('logout');
});
