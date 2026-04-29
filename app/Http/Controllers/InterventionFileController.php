<?php

namespace App\Http\Controllers;
use App\Models\InterventionFile;
use App\Models\FireStation;
use App\Models\InterventionType;
use Illuminate\Http\Request;

class InterventionFileController extends Controller
{
    public function index()
    {
        return view('interventionFiles');
    }
}