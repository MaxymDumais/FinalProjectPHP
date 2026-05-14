<?php
 
namespace App\Http\Controllers;
 
use App\Models\FireFighter;
use App\Models\FireStation;
use App\Models\InterventionFile;
use App\Models\State;
use App\Models\Vehicle;
use Illuminate\Http\Request;
 
// Controller for the FireStations
class FireStationController extends Controller
{
    //Function to access to the main page of the fireStations
    public function index()
    {
        $fireStations = FireStation::with('state')->orderBy('name')->get();
        $states = State::orderBy('description')->get();
 
        return view('fireStations', [
            'fireStations' => $fireStations,
            'states' => $states
        ]);
    }
 
    //Function used to add a fireStation to the list
    public function add(Request $request)
    {
        $exists = FireStation::where('name', $request->name)->exists();
        if (!$exists) {
            FireStation::create([
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'id_state' => $request->id_state,
                'phone' => $request->phone
            ]);
        }
 
        return redirect()->route('fireStationsPage');
    }
 
    //Function used to access to the formular for update a specific fireStation
    public function formModifyFireStation($id)
    {
        $fireStation = FireStation::findOrFail($id);
        $states = State::orderBy('description')->get();
 
        return view('fireStationModify', [
            'fireStation' => $fireStation,
            'states' => $states
        ]);
    }
 
    //Function used to update a specific fireStation
    public function update($id, Request $request)
    {
        $fireStation = FireStation::findOrFail($id);
 
        $fireStation->name = $request->name;
        $fireStation->address = $request->address;
        $fireStation->city = $request->city;
        $fireStation->id_state = $request->id_state;
        $fireStation->phone = $request->phone;
        $fireStation->save();
 
        return redirect()->route('fireStationsPage');
    }
 
    //Function used to delete a specific fireStation
    //The fireStation will not be deleted if it's linked to an intervention, a fireFighter or a vehicle
    public function delete($id)
    {
        $fireStation = FireStation::findOrFail($id);
 
        $interventionFiles = InterventionFile::all();
 
        $fireFighters = FireFighter::all();
 
        $vehicles = Vehicle::all();
 
        $isUsed = false;
 
        foreach ($interventionFiles as $if)
        {
            if ($if->idFireStation == $fireStation->id)
                $isUsed = true;
        }
        
        foreach ($fireFighters as $ff)
        {
            if ($ff->idFireStation == $fireStation->id)
                $isUsed = true;
        }
 
        foreach ($vehicles as $v)
        {
            if ($v->idFireStation == $fireStation->id)
                $isUsed = true;
        }
        
        if (!$isUsed)
            $fireStation->delete();
 
        return redirect()->back();
    }
 
    //Function used to clear all the fireStations
    //The clear list will not work if a fireStation is linked to an intervention, a fireFighter or a vehicle
    public function clear()
    {
        $interventionFiles = InterventionFile::all();
 
        $fireFighters = FireFighter::all();
 
        $vehicles = Vehicle::all();
    
        if ($vehicles->count() == 0 && $fireFighters->count() == 0 && $interventionFiles->count() == 0)
        FireStation::query()->delete();
        return redirect()->back();
    }
}