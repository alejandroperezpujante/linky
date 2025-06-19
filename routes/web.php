<?php

use Illuminate\Support\Facades\Route;

Route::view('', 'landing')->name('landing');

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/links.php';
require __DIR__.'/dashboard.php';
