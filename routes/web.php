<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('menu/pcmap');
});

Route::post('/schedules', [ScheduleController::class, 'store']);
Route::get('/schedules/by-item-number', [ScheduleController::class, 'getByItemNumber']);
Route::get('/order', [MenuItemController::class, 'index']);
Route::get('/menu-items', [MenuItemController::class, 'index']);
Route::get('/menu-items/{id}', [MenuItemController::class, 'show']);
terserah
Route::get('/orders/by-item-id', [OrderController::class, 'byItemId']);
Route::post('/orders', [OrderController::class, 'store']);

Route::post('/tes', [ScheduleController::class, 'store']);
Route::get('/tes/by-item-number', [ScheduleController::class, 'getByItemNumber']);
Route::get('/tes', [MenuItemController::class, 'index']);
Route::get('/wkwk', [MenuItemController::class, 'index']);
Route::get('/wkwk/{id}', [MenuItemController::class, 'show']);
Route::get('/orders/by-item-id', [OrderController::class, 'byItemId']);
Route::post('/orders', [OrderController::class, 'store']);
