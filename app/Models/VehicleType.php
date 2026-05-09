<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'vehicle_types';

    protected $fillable = [
        'code',
        'description'
    ];
}