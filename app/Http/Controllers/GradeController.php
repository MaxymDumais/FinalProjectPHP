<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\State;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::orderBy('id')->get();

        return view('grades', [
            'grades' => $grades
        ]);
    }

    public function add(Request $request)
    {
        
    }

    public function delete($id)
    {
        
    }

    public function clear()
    {
       
    }
}