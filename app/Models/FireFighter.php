<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireFighter extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'fireFighters';

    protected $fillable = [
        'id', 
        'matricule', 
        'idGrade', 
        'lastName', 
        'firstName',
        'idFireStation'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'idGrade');
    }

    public function fireStation()
    {
        return $this->belongsTo(FireStation::class, 'idFireStation');
    }
}