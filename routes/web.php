<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LinkManagementController;
use Illuminate\Support\Facades\Route;

Route::view('', 'landing')->name('landing');

Route::get('/{short_code}', LinkController::class)->name('link');

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth')->name('login');
    Route::post('login', [AuthenticationController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('links', [LinkManagementController::class, 'index'])->name('links.index');
    Route::get('links/create', [LinkManagementController::class, 'create'])->name('links.create');
    Route::post('links', [LinkManagementController::class, 'store'])->name('links.store');
    Route::get('links/{link}/edit', [LinkManagementController::class, 'edit'])->name('links.edit');
    Route::put('links/{link}', [LinkManagementController::class, 'update'])->name('links.update');
    Route::delete('links/{link}', [LinkManagementController::class, 'destroy'])->name('links.destroy');

    Route::delete('logout', [AuthenticationController::class, 'destroy'])->name('logout');
});
