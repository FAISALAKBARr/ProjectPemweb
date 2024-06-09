<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/block', [UserController::class, 'block'])->name('admin.users.block');
    Route::post('/admin/users/{user}/unblock', [UserController::class, 'unblock'])->name('admin.users.unblock');
});

Route::get('/', function () {
    return view('menu/pcmap');
});

Route::post('/schedules', [ScheduleController::class, 'store']);
Route::get('/schedules/by-item-number', [ScheduleController::class, 'getByItemNumber']);
Route::get('/order', [MenuItemController::class, 'index']);
Route::get('/menu-items', [MenuItemController::class, 'index']);
Route::get('/menu-items/{id}', [MenuItemController::class, 'show']);
Route::get('/orders/by-item-id', [OrderController::class, 'byItemId']);
Route::post('/orders', [OrderController::class, 'store']);
