<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Root redirect - always go to login if not authenticated
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
})->name('home');

// Dashboard route
Route::get('/dashboard', function () {
    return view('spa');
})->middleware(['auth', 'verified'])->name('dashboard');

// Catch all routes for the SPA (except root and auth routes)
Route::get('/{path?}', function () {
    return view('spa');
})->where('path', '(?!login|register|forgot-password|reset-password|verify-email).*')->name('spa');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
