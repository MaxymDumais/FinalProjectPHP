<?php

namespace App\Http\Controllers;

use App\Models\FireStation;
use App\Models\State;
use Illuminate\Http\Request;

class FireStationController extends Controller
{
    public function index()
    {
        $fireStations = FireStation::with('state')->orderBy('name')->get();
        $states = State::orderBy('description')->get();

        return view('fireStation', [
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

        return redirect()->route('mainPage');
    }

    public function delete($id)
    {
        $fireStation = FireStation::findOrFail($id);
        $fireStation->delete();
        return redirect()->back();
    }

    public function clear()
    {
        FireStation::query()->delete();
        return redirect()->back();
    }
}