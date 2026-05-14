<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
//The class of the vehicleType
class VehicleType extends Model
{
    use HasFactory;
 
    public $timestamps = false;
 
    //The table linked to the vehicleType
    protected $table = 'vehicle_types';
 
    //The attributes of the vehicleType
    protected $fillable = [
        'code',
        'description'
    ];
 
    //Link to the vehicles
    public function vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }
}