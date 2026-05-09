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
}