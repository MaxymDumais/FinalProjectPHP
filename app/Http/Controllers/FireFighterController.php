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

    public function add(Request $request)
    {
        $exists = FireFighter::where('matricule', $request->matricule)->exists();
        if (!$exists) {
            FireFighter::create([
            'matricule' => $request->matricule,
            'idGrade' => $request->idGrade,
            'idFireStation' => $request->idFireStation,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName
            ]);
        }
        
        return redirect()->route('fireFightersPage', $request->idFireStation);
    }

    public function delete($id)
    {
        $fireFighter = FireFighter::findOrFail($id);
        $fireFighter->delete();
        return redirect()->back();
    }

    public function clear($idFireStation)
    {
        FireFighter::where('idFireStation', $idFireStation)->delete();
        return redirect()->back();
    }
}