<?php

namespace App\Http\Controllers;

use App\Models\FireFighter;
use App\Models\Grade;
use App\Models\FireStation;
use Illuminate\Http\Request;

class FireFighterController extends Controller
{
    public function index($idFireStation)
    {
        if ($idFireStation === null) 
            $idFireStation = FireStation::first()->id;

        $fireStations = FireStation::all();

        $fireStation = FireStation::find($idFireStation);

        $grades = Grade::all();

        $fireFighters = FireFighter::where('idFireStation', $idFireStation)->orderBy('matricule')->get();
    
        return view('fireFighters', [
            'fireFighters' => $fireFighters,
            'grades' => $grades,
            'fireStation' => $fireStation,
            'fireStations' => $fireStations
        ]);
    }
}