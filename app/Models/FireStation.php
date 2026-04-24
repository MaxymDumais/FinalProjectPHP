<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireStation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'fire_stations';

    protected $fillable = [
        'name', 
        'address', 
        'city', 
        'phone', 
        'id_state'
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }
}