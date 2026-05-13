<?php

use App\Http\Controllers\FireFighterController;
use App\Http\Controllers\FireStationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InterventionFileController;
use App\Http\Controllers\InterventionTypeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
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
Route::get('/FireStations/{idFireStation}/InterventionFiles/{idCaptain}', [InterventionFileController::class, 'index'])->name('interventionFilesPage');
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
Route::delete('/FireFighters/{id}/delete', [FireFighterController::class, 'delete'])->name('deleteFireFighter');
Route::delete('/FireFighters/clear/{idFireStation}', [FireFighterController::class, 'clear'])->name('clearListFireFighter');
Route::get('/FireFighters/{id}/edit', [FireFighterController::class, 'formModifyFireFighter'])->name('formModifyFireFighter');
Route::post('/FireFighters/{id}/update', [FireFighterController::class, 'update'])->name('modifyFireFighter');

//Routes for the vehicle types
Route::get('/VehicleTypes', [VehicleTypeController::class, 'index'])->name('vehicleTypesPage');
Route::post('/VehicleTypes/add', [VehicleTypeController::class, 'add'])->name('addVehicleType');
Route::delete('/VehicleTypes/{id}/delete', [VehicleTypeController::class, 'delete'])->name('deleteVehicleType');
Route::delete('/VehicleTypes/clear', [VehicleTypeController::class, 'clear'])->name('clearListVehicleType');
Route::get('/VehicleTypes/{id}/edit', [VehicleTypeController::class, 'formModifyVehicleType'])->name('formModifyVehicleType');
Route::post('/VehicleTypes/{id}/update', [VehicleTypeController::class, 'update'])->name('modifyVehicleType');

//Routes for the vehicles
Route::get('/FireStations/{idFireStation}/Vehicles', [VehicleController::class, 'index'])->name('vehiclesPage');
Route::post('/Vehicles/add', [VehicleController::class, 'add'])->name('addVehicle');
Route::delete('/Vehicles/{id}/delete', [VehicleController::class, 'delete'])->name('deleteVehicle');
Route::delete('/Vehicles/clear/{idFireStation}', [VehicleController::class, 'clear'])->name('clearListVehicle');
