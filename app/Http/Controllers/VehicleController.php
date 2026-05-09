<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\FireStation;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index($idFireStation)
    {
        if ($idFireStation === null) 
            $idFireStation = FireStation::first()->id;

        $fireStations = FireStation::all();

        $fireStation = FireStation::find($idFireStation);

        $vehicleTypes = VehicleType::all();

        $vehicles = Vehicle::where('idFireStation', $idFireStation)->orderBy('identificationNumber')->get();
    
        return view('vehicles', [
            'vehicles' => $vehicles,
            'vehicleTypes' => $vehicleTypes,
            'fireStation' => $fireStation,
            'fireStations' => $fireStations
        ]);
    }
}