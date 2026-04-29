<?php

use App\Http\Controllers\FireStationController;
use App\Http\Controllers\InterventionFileController;
use App\Http\Controllers\InterventionTypeController;
use App\Models\InterventionFile;
use App\Models\InterventionType;
use Illuminate\Support\Facades\Route;

//Routes for the fire stations
Route::get('/', [FireStationController::class, 'index'])->name('fireStationsPage');
Route::get('/FireStations', [FireStationController::class, 'index'])->name('fireStationsPage');
Route::post('/FireStations/add', [FireStationController::class, 'add'])->name('addFireStation');
Route::delete('/FireStations/{id}/delete', [FireStationController::class, 'delete'])->name('deleteFireStation');
Route::delete('/FireStations/clear', [FireStationController::class, 'clear'])->name('clearListFireStation');
Route::get('/FireStation/{id}/edit', [FireStationController::class, 'formModifyFireStation'])->name('formModifyFireStation');
Route::post('/FireStation/{id}/update', [FireStationController::class, 'update'])->name('modifyFireStation');

//Routes for the intervention types
Route::get('/InterventionTypes', [InterventionTypeController::class, 'index'])->name('interventionTypesPage');
Route::post('/InterventionTypes/add', [InterventionTypeController::class, 'add'])->name('addInterventionType');

//Routes for the intervention files
Route::get('/InterventionFiles', [InterventionFileController::class, 'index'])->name('interventionFilesPage');
