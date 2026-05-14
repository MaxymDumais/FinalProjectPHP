<?php
 
namespace App\Http\Controllers;
 
use App\Models\InterventionFile;
use App\Models\InterventionType;
use Illuminate\Http\Request;
 
// Controller for the InterventionTypes
class InterventionTypeController extends Controller
{
    //Function to access to the main page of the interventionTypes
    public function index()
    {
        $interventionTypes = InterventionType::orderBy('interventionNumber')->get();
        return view('interventionTypes', [
            'interventionTypes' => $interventionTypes
        ]);
    }
 
    //Function used to add an interventionType to the list
    public function add(Request $request)
    {
        $exists = InterventionType::where('interventionNumber', $request->interventionNumber)->exists();
        if (!$exists) {
            InterventionType::create([
                'interventionNumber' => $request->interventionNumber,
                'description' => $request->description
            ]);
        }

        return redirect()->route('interventionTypesPage');
    }
 
    //Function used to access to the formular for update a specific interventionType
    public function formModifyInterventionType($id)
    {
        $interventionType = InterventionType::findOrFail($id);
 
        return view('interventionTypeModify', [
            'interventionType' => $interventionType
        ]);
    }
 
    //Function used to update a specific interventionType
    public function update($id, Request $request)
    {
        $interventionType = InterventionType::findOrFail($id);
 
        $interventionType->interventionNumber = $request->interventionNumber;
        $interventionType->description = $request->description;
        $interventionType->save();
 
        return redirect()->route('interventionTypesPage');
    }
 
    //Function used to delete a specific interventionType
    //The interventionType will not be deleted if it's linked to an intervention
    public function delete($id)
    {
        $interventionType = InterventionType::findOrFail($id);
 
        $interventionFiles = InterventionFile::all();
 
        $isUsed = false;
 
        foreach ($interventionFiles as $if)
        {
            if ($if->idInterventionType == $interventionType->id)
                $isUsed = true;
        }
 
        if (!$isUsed)
            $interventionType->delete();
        
        return redirect()->back();
    }
 
    //Function used to clear all the interventionTypes
    //The clear list will not work if an interventionType is linked to an intervention
    public function clear()
    {
        $interventionFiles = InterventionFile::all();
 
        if ($interventionFiles->count() == 0)
            InterventionType::query()->delete();
        return redirect()->back();
    }
}