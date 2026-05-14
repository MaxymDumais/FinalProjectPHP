<?php

namespace App\Http\Controllers;

use App\Models\FireFighter;
use App\Models\FireStation;
use App\Models\InterventionFile;
use App\Models\State;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class FireStationController extends Controller
{
    public function index()
    {
        $fireStations = FireStation::with('state')->orderBy('name')->get();
        $states = State::orderBy('description')->get();

        return view('fireStations', [
            'fireStations' => $fireStations,
            'states' => $states
        ]);
    }

    public function add(Request $request)
    {
        FireStation::create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'id_state' => $request->id_state,
            'phone' => $request->phone
        ]);

        return redirect()->route('fireStationsPage');
    }

    public function formModifyFireStation($id)
    {
        $fireStation = FireStation::findOrFail($id);
        $states = State::orderBy('description')->get();

        return view('fireStationModify', [
            'fireStation' => $fireStation,
            'states' => $states
        ]);
    }
    
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