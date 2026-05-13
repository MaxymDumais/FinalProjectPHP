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

    public function add(Request $request)
    {
        $exists = Vehicle::where('identificationNumber', $request->identificationNumber)->exists();
        if (!$exists) {
            Vehicle::create([
            'identificationNumber' => $request->identificationNumber,
            'registration' => $request->registration,
            'startYear' => $request->startYear,
            'brand' => $request->brand,
            'model' => $request->model,
            'idVehicleType' => $request->idVehicleType,
            'idFireStation' => $request->idFireStation
            ]);
        }
        
        return redirect()->route('vehiclesPage', $request->idFireStation);
    }

    public function formModifyVehicle($id)
    {
    $vehicle = Vehicle::findOrFail($id);

    return view('vehicleModify', [
        'vehicle' => $vehicle,
        'vehicleTypes' => VehicleType::all(),
        'idFireStation' => $vehicle->idFireStation
    ]);
    }

    public function update($id, Request $request)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->identificationNumber = $request->identificationNumber;
        $vehicle->registration = $request->registration;
        $vehicle->startYear = $request->startYear;
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->idVehicleType = $request->idVehicleType; 
        $vehicle->idFireStation = $request->idFireStation;        
        $vehicle->save();

        return redirect()->route('vehiclesPage', $request->idFireStation);
    }

    public function delete($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return redirect()->back();
    }

    public function clear($idFireStation)
    {
        Vehicle::where('idFireStation', $idFireStation)->delete();
        return redirect()->back();
    }
}