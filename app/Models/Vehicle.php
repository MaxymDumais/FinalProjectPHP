<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'vehicles';

    protected $fillable = [
        'identificationNumber', 
        'registration', 
        'startYear', 
        'brand',
        'model',
        'idVehicleType',
        'idFireStation'
    ];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'idVehicleType');
    }
}