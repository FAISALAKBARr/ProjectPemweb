<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('pcmap');
});

Route::post('/schedules', [ScheduleController::class, 'store']);
Route::get('/schedules/by-item-number', [ScheduleController::class, 'getByItemNumber']);
