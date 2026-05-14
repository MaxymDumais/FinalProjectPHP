<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicleTypes = VehicleType::orderBy('code')->get();

        return view('vehicleTypes', [
            'vehicleTypes' => $vehicleTypes
        ]);
    }

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

    public function formModifyVehicleType($id)
    {
        $vehicleType = VehicleType::findOrFail($id);

        return view('vehicleTypeModify', [
            'vehicleType' => $vehicleType
        ]);
    }

    public function update($id, Request $request)
    {
        $vehicleType = VehicleType::findOrFail($id);

        $vehicleType->code = $request->code;
        $vehicleType->description = $request->description;
        $vehicleType->save();

        return redirect()->route('vehicleTypesPage');
    }

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

    public function clear()
    {
        $vehicles = Vehicle::all();

        if ($vehicles->count() == 0)
            VehicleType::query()->delete();

        return redirect()->back();
    }
}