<?php

namespace App\Http\Controllers;

use App\Models\FireStation;
use Illuminate\Http\Request;

class FireStationController extends Controller
{
    public function index()
    {
        return view('fireStation');
    }
}