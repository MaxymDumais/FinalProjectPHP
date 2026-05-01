<?php

namespace App\Http\Controllers;
use App\Models\InterventionFile;
use App\Models\FireStation;
use App\Models\InterventionType;
use Illuminate\Http\Request;

class InterventionFileController extends Controller
{
    public function index(int $idFireStation)
    {
        if ($idFireStation === null) 
            $idFireStation = FireStation::first()->id;

        $fireStations = FireStation::all();

        $fireStation = FireStation::find($idFireStation);

        $interventionFiles = InterventionFile::where('idFireStation', $idFireStation)->orderBy('dateTimeIntervention')->get();

        return view('interventionFiles', [
            'interventionFiles' => $interventionFiles,
            'fireStation' => $fireStation,
            'fireStations' => $fireStations
        ]);
    }
}