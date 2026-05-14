<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
//The class of the interventionType
class InterventionType extends Model
{
    use HasFactory;
 
    public $timestamps = false;
 
    //The table linked to the interventionType
    protected $table = 'intervention_types';
 
    //The attributes of the interventionType
    protected $fillable = [
        'interventionNumber',
        'description'
    ];
 
    //Link to the intervention files
    public function interventionFiles()
    {
        return $this->hasMany(InterventionFile::class);
    }
}