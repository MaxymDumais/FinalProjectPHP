<?php

namespace App\Http\Controllers;

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
}