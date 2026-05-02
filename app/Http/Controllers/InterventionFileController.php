<?php

namespace App\Http\Controllers;
use App\Models\InterventionFile;
use App\Models\FireStation;
use App\Models\InterventionType;
use Illuminate\Http\Request;

class InterventionFileController extends Controller
{
    public function index($idFireStation)
    {
        if ($idFireStation === null) 
            $idFireStation = FireStation::first()->id;

        $fireStations = FireStation::all();

        $fireStation = FireStation::find($idFireStation);

        $interventionTypes = InterventionType::all();

        $interventionFiles = InterventionFile::where('idFireStation', $idFireStation)->orderBy('dateTimeIntervention')->get();

        return view('interventionFiles', [
            'interventionFiles' => $interventionFiles,
            'interventionTypes' => $interventionTypes,
            'fireStation' => $fireStation,
            'fireStations' => $fireStations
        ]);
    }

    public function add(Request $request)
    {
        InterventionFile::create([
            'dateTimeIntervention' => now(),
            'address' => $request->address,
            'idFireStation' => $request->idFireStation,
            'idInterventionType' => $request->idInterventionType,
            'summary' => $request->summary
        ]);
        return redirect()->route('interventionFilesPage', $request->idFireStation);
    }

    public function delete($id)
    {
        $interventionFile = InterventionFile::findOrFail($id);
        $interventionFile->delete();
        return redirect()->back();
    }

    public function clear($idFireStation)
    {
        InterventionFile::where('idFireStation', $idFireStation)->delete();
        return redirect()->back();
    }
}