<?php

use App\Http\Middleware\EnsureAdmin; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.cs');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'fetchMessages']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
});

Route::middleware(['auth', EnsureAdmin::class])->group(function () { // Gunakan kelas EnsureAdmin secara langsung
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
    Route::get('/admin/payments', [AdminPaymentController::class, 'payments'])->name('admin.payments');
    Route::delete('/payments/{payment}', [AdminPaymentController::class, 'destroy'])->name('admin.payments.destroy');
    Route::patch('/admin/payments/{id}/confirm', [PaymentController::class, 'confirm'])->name('admin.payments.confirm');
    
    Route::post('/admin/block/{id}', [AdminController::class, 'block'])->name('admin.block');
    Route::post('/admin/unblock/{id}', [AdminController::class, 'unblock'])->name('admin.unblock');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('menu.place');
    });
    
    Route::get('/pcmap', function () {
        return view('menu.pcmap');
    })->name('pcmap');

    Route::get('/places', [PlaceController::class, 'show'])->name('places.show');
    Route::post('/places/select', [PlaceController::class, 'select'])->name('places.select');

    Route::get('/schedules/by-item-number', [ScheduleController::class, 'getSchedulesByItemNumber']);
    Route::get('/schedules/check-overlap', [ScheduleController::class, 'checkOverlap']);

    Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/upload', [PaymentController::class, 'uploadPaymentProof'])->name('payment.upload');

    Route::get('/order', [MenuItemController::class, 'index']);
    Route::get('/menu-items', [MenuItemController::class, 'index']);
    Route::get('/menu-items/{id}', [MenuItemController::class, 'show']);
    Route::get('/orders/by-item-id', [OrderController::class, 'byItemId']);
    Route::post('/orders', [OrderController::class, 'store']);

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');    
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
