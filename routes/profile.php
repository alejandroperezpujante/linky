<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('profile/email/update', [ProfileController::class, 'updateEmail'])->name('profile.email.update');
    Route::post('profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
}); 