<?php
 
namespace App\Http\Controllers;
 
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
 
// Controller for the VehicleTypes
class VehicleTypeController extends Controller
{
    //Function to access to the main page of the vehicleTypes
    public function index()
    {
        $vehicleTypes = VehicleType::orderBy('code')->get();
 
        return view('vehicleTypes', [
            'vehicleTypes' => $vehicleTypes
        ]);
    }
 
    //Function used to add a vehicleType to the list
    public function add(Request $request)
    {
        $exists = VehicleType::where('code', $request->code)->exists();
        if (!$exists) {
            VehicleType::create([
                'code' => $request->code,
                'description' => $request->description
            ]);
        }
        return redirect()->route('vehicleTypesPage');
    }
 
    //Function used to access to the formular for update a specific vehicleType
    public function formModifyVehicleType($id)
    {
        $vehicleType = VehicleType::findOrFail($id);
 
        return view('vehicleTypeModify', [
            'vehicleType' => $vehicleType
        ]);
    }
 
    //Function used to update a specific vehicleType
    public function update($id, Request $request)
    {
        $vehicleType = VehicleType::findOrFail($id);
 
        $vehicleType->code = $request->code;
        $vehicleType->description = $request->description;
        $vehicleType->save();
 
        return redirect()->route('vehicleTypesPage');
    }
 
    //Function used to delete a specific vehicleType
    //The vehicleType will not be deleted if it's linked to a vehicle
    public function delete($id)
    {
        $vehicleType = VehicleType::findOrFail($id);
 
        $vehicles = Vehicle::all();
 
        $isUsed = false;
 
        foreach ($vehicles as $v)
        {
            if ($v->vehicleType->id == $vehicleType->id)
                $isUsed = true;
        }
 
        if (!$isUsed)
            $vehicleType->delete();
 
        return redirect()->back();
    }
 
    //Function used to clear all the vehicleTypes
    //The clear list will not work if a vehicleType is linked to a vehicle
    public function clear()
    {
        $vehicles = Vehicle::all();
 
        if ($vehicles->count() == 0)
            VehicleType::query()->delete();
 
        return redirect()->back();
    }
}