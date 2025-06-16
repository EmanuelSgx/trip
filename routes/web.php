<?php

use Illuminate\Support\Facades\Route;

// Catch all routes for the SPA
Route::get('/{path?}', function () {
    return view('spa');
})->where('path', '.*')->name('spa');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
