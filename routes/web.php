<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/block', [UserController::class, 'block'])->name('admin.users.block');
    Route::post('/admin/users/{user}/unblock', [UserController::class, 'unblock'])->name('admin.users.unblock');

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'create'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);