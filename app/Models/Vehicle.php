<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
//The class of the vehicle
class Vehicle extends Model
{
    use HasFactory;
 
    public $timestamps = false;
 
    //The table linked to the vehicle
    protected $table = 'vehicles';
 
    //The attributes of the vehicle
    protected $fillable = [
        'identificationNumber', 
        'registration', 
        'startYear', 
        'brand',
        'model',
        'idVehicleType',
        'idFireStation'
    ];
 
    //Link to the vehicle type
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'idVehicleType');
    }
}