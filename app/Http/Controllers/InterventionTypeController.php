<?php

namespace App\Http\Controllers;

use App\Models\InterventionType;
use Illuminate\Http\Request;

class InterventionTypeController extends Controller
{
    public function index()
    {
        return view('interventionTypes');
    }
}