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
        $exists = Grade::where('description', $request->description)->exists();
        if (!$exists) {
            Grade::create([
            'description' => $request->description,
            ]);
        }
        return redirect()->route('gradesPage');
    }

    public function delete($id)
    {
        
    }

    public function clear()
    {
       
    }
}