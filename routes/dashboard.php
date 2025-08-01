<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', DashboardController::class)
    ->middleware('auth')
    ->name('dashboard');