<?php

use App\Http\Controllers\FireFighterController;
use App\Http\Controllers\FireStationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InterventionFileController;
use App\Http\Controllers\InterventionTypeController;
use App\Models\FireFighter;
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
Route::delete('/InterventionTypes/{id}/delete', [InterventionTypeController::class, 'delete'])->name('deleteInterventionType');
Route::delete('/InterventionTypes/clear', [InterventionTypeController::class, 'clear'])->name('clearListInterventionType');
Route::get('/InterventionTypes/{id}/edit', [InterventionTypeController::class, 'formModifyInterventionType'])->name('formModifyInterventionType');
Route::post('/InterventionTypes/{id}/update', [InterventionTypeController::class, 'update'])->name('modifyInterventionType');

//Routes for the intervention files
Route::get('/FireStations/{idFireStation}/InterventionFiles', [InterventionFileController::class, 'index'])->name('interventionFilesPage');
Route::post('/InterventionFiles/add', [InterventionFileController::class, 'add'])->name('addInterventionFile');
Route::delete('/InterventionFiles/{id}/delete', [InterventionFileController::class, 'delete'])->name('deleteInterventionFile');
Route::delete('/InterventionFiles/clear/{idFireStation}', [InterventionFileController::class, 'clear'])->name('clearListInterventionFile');
Route::get('/InterventionFiles/{id}/edit', [InterventionFileController::class, 'formModifyInterventionFile'])->name('formModifyInterventionFile');
Route::post('/InterventionFiles/{id}/update', [InterventionFileController::class, 'update'])->name('modifyInterventionFile');

//Routes for the grades
Route::get('/Grades', [GradeController::class, 'index'])->name('gradesPage');
Route::post('/Grades/add', [GradeController::class, 'add'])->name('addGrade');
Route::delete('/Grades/{id}/delete', [GradeController::class, 'delete'])->name('deleteGrade');
Route::delete('/Grades/clear', [GradeController::class, 'clear'])->name('clearListGrade');

//Routes for the fireFighters
Route::get('/FireStations/{idFireStation}/FireFighters', [FireFighterController::class, 'index'])->name('fireFightersPage');
Route::post('/FireFighters/add', [FireFighterController::class, 'add'])->name('addFireFighter');


