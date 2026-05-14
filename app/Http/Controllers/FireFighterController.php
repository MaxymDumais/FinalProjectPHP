<?php

namespace App\Http\Controllers;

use App\Models\FireFighter;
use App\Models\Grade;
use App\Models\FireStation;
use App\Models\InterventionFile;
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

    public function formModifyFireFighter($id)
    {
    $fireFighter = FireFighter::findOrFail($id);

    return view('fireFighterModify', [
        'fireFighter' => $fireFighter,
        'grades' => Grade::all(),
        'idFireStation' => $fireFighter->idFireStation
    ]);
    }

    public function update($id, Request $request)
    {
        $fireFighter = FireFighter::findOrFail($id);

        $fireFighter->matricule = $request->matricule;
        $fireFighter->idGrade = $request->idGrade;
        $fireFighter->lastName = $request->lastName;
        $fireFighter->firstName = $request->firstName;
        $fireFighter->idFireStation = $request->idFireStation;        
        $fireFighter->save();

        return redirect()->route('fireFightersPage', $request->idFireStation);
    }

    public function delete($id)
    {
        $fireFighter = FireFighter::findOrFail($id);

        $interventionFiles = InterventionFile::all();

        $isUsed = false;

        foreach ($interventionFiles as $if)
        {
            if ($if->idCaptain == $fireFighter->id)
                $isUsed = true;
        }

        if (!$isUsed)
            $fireFighter->delete();
        
        return redirect()->back();
    }

    public function clear($idFireStation)
    {
        $interventionFiles = InterventionFile::where('idFireStation', $idFireStation)->get();

        $fireFighters = FireFighter::where('idFireStation', $idFireStation)->get();

        $isUsed = false;

        foreach ($interventionFiles as $if)
        {
            foreach ($fireFighters as $ff)
            {
                if ($ff->id == $if->idCaptain)
                    $isUsed = true;
            }
        }

        if (!$isUsed)
            FireFighter::where('idFireStation', $idFireStation)->delete();
        
        return redirect()->back();
    }
}