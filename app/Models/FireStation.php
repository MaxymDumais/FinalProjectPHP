<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
//The class of the fireStation
class FireStation extends Model
{
    use HasFactory;
 
    public $timestamps = false;
 
    //The table linked to the fireStation
    protected $table = 'fire_stations';
 
    //The attributes of the fireStation
    protected $fillable = [
        'name', 
        'address', 
        'city', 
        'phone', 
        'id_state'
    ];
 
    //Link to the state
    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }
 
    //Link to the intervention files
    public function interventionFiles()
    {
        return $this->hasMany(InterventionFile::class);
    }
 
    //Link to the firefighters
    public function fireFighter()
    {
        return $this->hasMany(FireFighter::class);
    }
}