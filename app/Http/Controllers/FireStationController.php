<?php

namespace App\Http\Controllers;

use App\Models\FireStation;
use Illuminate\Http\Request;

class FireStationController extends Controller
{
    public function index()
    {
        $fireStations = FireStation::with('state')->orderBy('name')->get();

        return view('fireStation', [
            'fireStations' => $fireStations
        ]);
    }

    
}