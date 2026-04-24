<?php

use App\Http\Controllers\FireStationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FireStationController::class, 'index'])->name('mainPage');
Route::get('/FireStations', [FireStationController::class, 'index'])->name('mainPage');
Route::post('/FireStations/add', [FireStationController::class, 'add'])->name('addFireStation');
