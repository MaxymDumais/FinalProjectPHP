<?php

namespace App\Http\Controllers;

use App\Models\FireFighter;
use App\Models\Grade;
use App\Models\FireStation;
use App\Models\InterventionFile;
use Illuminate\Http\Request;

// Controller for the FireFighters
class FireFighterController extends Controller
{
    //Function to access to the main page of the fireFighters
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

    //Function used to add a fireFighter to the list
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

    //Function used to access to the formular for update a specific fireFighter
    public function formModifyFireFighter($id)
    {
    $fireFighter = FireFighter::findOrFail($id);

    return view('fireFighterModify', [
        'fireFighter' => $fireFighter,
        'grades' => Grade::all(),
        'idFireStation' => $fireFighter->idFireStation
    ]);
    }

    //Function used to update a specific fireFighter
    //If the fireFighter is a captain and some interventions are linked to him, the modification of the grade of the fireFighter will not be allowed
    public function update($id, Request $request)
    {
        $fireFighter = FireFighter::findOrFail($id);

        $interventionFiles = InterventionFile::all();

        $isUsed = false;

        $fireFighter->matricule = $request->matricule;
        foreach ($interventionFiles as $if) {
            if ($if->idCaptain == $fireFighter->id)
                $isUsed = true;
        }
        if (!$isUsed)
            $fireFighter->idGrade = $request->idGrade;
        else
            $fireFighter->idGrade = $fireFighter->idGrade;
        $fireFighter->lastName = $request->lastName;
        $fireFighter->firstName = $request->firstName;
        $fireFighter->idFireStation = $request->idFireStation;        
        $fireFighter->save();

        return redirect()->route('fireFightersPage', $request->idFireStation);
    }

    //Function used to delete a specific fireFighter
    //The firefighter will not be deleted if he's linked to an intervention
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

    //Function used to clear the firefighters of an fire station
    //The clear list will not work if a firefighter of the list is linked to an intervention
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