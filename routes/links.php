<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/link/{short_code}', [LinkController::class, 'external'])->name('link.external');

Route::middleware('auth')->group(function () {
    Route::get('links', [LinkController::class, 'index'])->name('links.index');
    Route::get('links/create', [LinkController::class, 'create'])->name('links.create');
    Route::post('links', [LinkController::class, 'store'])->name('links.store');
    Route::get('links/{link}/edit', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('links/{link}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
    Route::patch('links/{link}/status', [LinkController::class, 'toggleStatus'])->name('links.toggle');
}); 