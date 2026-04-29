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
}