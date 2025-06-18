<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LinkManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToggleLinkStatusController;
use App\Http\Controllers\UpdateProfileEmailController;
use App\Http\Controllers\UpdateProfilePasswordController;
use Illuminate\Support\Facades\Route;

Route::view('', 'landing')->name('landing');

Route::get('/link/{short_code}', LinkController::class)->name('link.external');

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth')->name('login');
    Route::post('login', [AuthenticationController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('profile', ProfileController::class)->name('profile');
    Route::post('profile/email/update', UpdateProfileEmailController::class)->name('profile.email.update');
    Route::post('profile/password/update', UpdateProfilePasswordController::class)->name('profile.password.update');

    Route::get('links', [LinkManagementController::class, 'index'])->name('links.index');
    Route::get('links/create', [LinkManagementController::class, 'create'])->name('links.create');
    Route::post('links', [LinkManagementController::class, 'store'])->name('links.store');
    Route::get('links/{link}/edit', [LinkManagementController::class, 'edit'])->name('links.edit');
    Route::put('links/{link}', [LinkManagementController::class, 'update'])->name('links.update');
    Route::delete('links/{link}', [LinkManagementController::class, 'destroy'])->name('links.destroy');
    Route::patch('links/{link}/status', ToggleLinkStatusController::class)->name('links.toggle');

    Route::delete('logout', [AuthenticationController::class, 'destroy'])->name('logout');
});
