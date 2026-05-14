<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//The class of the firefighter
class FireFighter extends Model
{
    use HasFactory;

    public $timestamps = false;

    //the table linked to the firefighter
    protected $table = 'fireFighters';

    //The attributes of the fireFighter
    protected $fillable = [
        'id', 
        'matricule', 
        'idGrade', 
        'lastName', 
        'firstName',
        'idFireStation'
    ];

    //Link to the grade
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'idGrade');
    }

    //Link to the fire station
    public function fireStation()
    {
        return $this->belongsTo(FireStation::class, 'idFireStation');
    }

    //Link to the fire stations
    public function interventionFiles()
    {
        return $this->hasMany(FireStation::class);
    }
}