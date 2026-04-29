<?php

namespace App\Http\Controllers;

use App\Models\InterventionType;
use Illuminate\Http\Request;

class InterventionTypeController extends Controller
{
    public function index()
    {
        $interventionTypes = InterventionType::orderBy('interventionNumber')->get();
        return view('interventionTypes', [
            'interventionTypes' => $interventionTypes
        ]);
    }

    public function add(Request $request)
    {
        InterventionType::create([
            'interventionNumber' => $request->interventionNumber,
            'description' => $request->description
        ]);
        return redirect()->route('interventionTypesPage');
    }

    public function delete($id)
    {
        $interventionType = InterventionType::findOrFail($id);
        $interventionType->delete();
        return redirect()->back();
    }

    public function clear()
    {
        InterventionType::query()->delete();
        return redirect()->back();
    }
}