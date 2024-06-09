<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('menu.pcmap');
    });
    
    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::get('/schedules/by-item-number', [ScheduleController::class, 'getByItemNumber']);

    Route::get('/order', [MenuItemController::class, 'index']);
    Route::get('/menu-items', [MenuItemController::class, 'index']);
    Route::get('/menu-items/{id}', [MenuItemController::class, 'show']);
    Route::get('/orders/by-item-id', [OrderController::class, 'byItemId']);
    Route::post('/orders', [OrderController::class, 'store']);
});

<<<<<<< HEAD
Route::post('/schedules', [ScheduleController::class, 'store']);
Route::get('/schedules/by-item-number', [ScheduleController::class, 'getByItemNumber']);
Route::get('/order', [MenuItemController::class, 'index']);
Route::get('/menu-items', [MenuItemController::class, 'index']);
Route::get('/menu-items/{id}', [MenuItemController::class, 'show']);
Route::get('/orders/by-item-id', [OrderController::class, 'byItemId']);
Route::post('/orders', [OrderController::class, 'store']);
=======
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'create'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
>>>>>>> b24b6d7d5cc67ff324d5c83221bb70930ff4d97c
