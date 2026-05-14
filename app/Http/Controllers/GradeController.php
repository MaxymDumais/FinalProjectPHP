<?php
 
namespace App\Http\Controllers;
 
use App\Models\FireFighter;
use App\Models\Grade;
use App\Models\State;
use Illuminate\Http\Request;
 
// Controller for the Grades
class GradeController extends Controller
{
    //Function to access to the main page of the grades
    public function index()
    {
        $grades = Grade::orderBy('id')->get();
 
        return view('grades', [
            'grades' => $grades
        ]);
    }
 
    //Function used to add a grade to the list
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
 
    //Function used to delete a specific grade
    //The grade will not be deleted if it's linked to a fireFighter
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
 
    //Function used to clear all the grades
    //The clear list will not work if a grade is linked to a fireFighter
    public function clear()
    {
        $fireFighters = FireFighter::all();
 
        if ($fireFighters->count() == 0)
            Grade::query()->delete();
        
        return redirect()->back();
    }
}
