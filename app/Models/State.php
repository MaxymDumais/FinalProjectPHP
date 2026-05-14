<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
//The class of the state
class State extends Model
{
    use HasFactory;
 
    public $timestamps = false;
 
    //The table linked to the state
    protected $table = 'states';
 
    //The attributes of the state
    protected $fillable = [
        'description'
    ];
 
    //Link to the fire stations
    public function fireStations()
    {
        return $this->hasMany(FireStation::class);
    }
}