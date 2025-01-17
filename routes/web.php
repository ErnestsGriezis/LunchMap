<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\MenuController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Registration Routes
Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest');

// Login Routes
Route::get('/login', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->middleware('guest');

// Logout Route
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/places', [PlaceController::class, 'store'])->name('places.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/cafes/{cafe}/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('/cafes/{cafe}/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::patch('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
});
