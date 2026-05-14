<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
//The class of the interventionFile
class InterventionFile extends Model
{
    use HasFactory;
 
    public $timestamps = false;
 
    //The table linked to the interventionFile
    protected $table = 'intervention_files';
 
    //The attributes of the interventionFile
    protected $fillable = [
        'dateTimeIntervention', 
        'address', 
        'idInterventionType', 
        'idFireStation', 
        'summary',
        'idCaptain'
    ];
 
    //Link to the intervention type
    public function interventionType()
    {
        return $this->belongsTo(InterventionType::class, 'idInterventionType');
    }
 
    //Link to the fire station
    public function fireStation()
    {
        return $this->belongsTo(FireStation::class, 'idFireStation');
    }
 
    //Link to the captain
    public function captain()
    {
        return $this->belongsTo(FireFighter::class, 'idCaptain');
    }
}