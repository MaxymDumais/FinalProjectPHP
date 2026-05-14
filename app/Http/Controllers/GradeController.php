<?php

namespace App\Http\Controllers;

use App\Models\FireFighter;
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
        $grade = Grade::findOrFail($id);

        $fireFighters = FireFighter::all();

        $isUsed = false;

        foreach ($fireFighters as $ff)
        {
            if ($ff->idGrade == $grade->id)
                $isUsed = true;
        }

        if (!$isUsed)
            $grade->delete();
        
        return redirect()->back();
    }

    public function clear()
    {
        $fireFighters = FireFighter::all();

        if ($fireFighters->count() == 0)
            Grade::query()->delete();
        
        return redirect()->back();
    }
}