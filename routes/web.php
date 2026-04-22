<?php

use App\Http\Controllers\FireStationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FireStationController::class, 'index'])->name('welcome');
