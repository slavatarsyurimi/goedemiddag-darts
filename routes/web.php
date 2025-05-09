<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\DartsMatchController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('players', PlayerController::class)
    ->only(['index', 'create', 'store', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('matches', DartsMatchController::class)
    ->only(['index', 'create', 'store', 'destroy'])
    ->middleware(['auth', 'verified']);

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
