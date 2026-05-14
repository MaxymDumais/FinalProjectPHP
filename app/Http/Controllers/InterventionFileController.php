<?php
 
namespace App\Http\Controllers;
use App\Models\InterventionFile;
use App\Models\FireStation;
use App\Models\InterventionType;
use App\Models\FireFighter;
use Illuminate\Http\Request;
 
// Controller for the InterventionFiles
class InterventionFileController extends Controller
{
    //Function to access to the main page of the interventionFiles
    public function index($idFireStation, $idCaptain)
    {
        if ($idFireStation === null) 
            $idFireStation = FireStation::first()->id;
 
        if ($idCaptain === null)
            $idCaptain = FireFighter::whereHas('grade', function ($query) {$query->where('description', 'Capitaine');})->first()->id;
 
        $captains = FireFighter::where('idFireStation', $idFireStation)->whereHas('grade', function ($query) {$query->where('description', 'Capitaine');})->get();
 
        $captain = FireFighter::find($idCaptain);
 
        $fireStations = FireStation::all();
 
        $fireStation = FireStation::find($idFireStation);
 
        $interventionTypes = InterventionType::all();
 
        $interventionFiles = InterventionFile::where('idFireStation', $idFireStation)->where('idCaptain', $idCaptain)->orderBy('dateTimeIntervention')->get();
        
 
        return view('interventionFiles', [
            'interventionFiles' => $interventionFiles,
            'interventionTypes' => $interventionTypes,
            'fireStation' => $fireStation,
            'fireStations' => $fireStations,
            'captains' => $captains,
            'captain' => $captain
        ]);
    }
 
    //Function used to add an interventionFile to the list
    public function add(Request $request)
    {
        InterventionFile::create([
            'dateTimeIntervention' => now(),
            'address' => $request->address,
            'idFireStation' => $request->idFireStation,
            'idInterventionType' => $request->idInterventionType,
            'summary' => $request->summary,
            'idCaptain' => $request->idCaptain
        ]);
        return redirect()->route('interventionFilesPage', [$request->idFireStation, $request->idCaptain]);
    }
 
    //Function used to access to the formular for update a specific interventionFile
    public function formModifyInterventionFile($id)
    {
    $interventionFile = InterventionFile::findOrFail($id);
 
    return view('interventionFileModify', [
        'interventionFile' => $interventionFile,
        'interventionTypes' => InterventionType::all(),
        'idFireStation' => $interventionFile->idFireStation,
        'idCaptain' => $interventionFile->idCaptain
    ]);
    }
 
    //Function used to update a specific interventionFile
    public function update($id, Request $request)
    {
        $interventionFile = InterventionFile::findOrFail($id);
 
        $interventionFile->dateTimeIntervention = $request->dateTimeIntervention;
        $interventionFile->address = $request->address;
        $interventionFile->idInterventionType = $request->idInterventionType;
        $interventionFile->idFireStation = $request->idFireStation;
        $interventionFile->summary = $request->summary;        
        $interventionFile->save();
 
        return redirect()->route('interventionFilesPage', [$request->idFireStation, $request->idCaptain]);
    }
 
    //Function used to delete a specific interventionFile
    public function delete($id)
    {
        $interventionFile = InterventionFile::findOrFail($id);
        $interventionFile->delete();
        return redirect()->back();
    }
 
    //Function used to clear the interventionFiles of a fire station
    public function clear($idFireStation)
    {
        InterventionFile::where('idFireStation', $idFireStation)->delete();
        return redirect()->back();
    }
}