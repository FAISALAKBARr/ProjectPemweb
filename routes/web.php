<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;
<<<<<<< HEAD
use App\Http\Middleware\EnsureAdmin; 
use App\Http\Controllers\ChatController;

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.cs');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'fetchMessages']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
});

Route::middleware(['auth', EnsureAdmin::class])->group(function () { // Gunakan kelas EnsureAdmin secara langsung
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/block/{id}', [AdminController::class, 'block'])->name('admin.block');
    Route::post('/admin/unblock/{id}', [AdminController::class, 'unblock'])->name('admin.unblock');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});

=======

>>>>>>> d945ae7bc962db086d6800565fbe615c4698cfdd
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'create'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);