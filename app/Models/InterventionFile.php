<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionFile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'intervention_files';

    protected $fillable = [
        'dateTimeIntervention', 
        'address', 
        'idInterventionType', 
        'idFireStation', 
        'summary'
    ];

    public function interventionType()
    {
        return $this->belongsTo(InterventionType::class, 'idInterventionType');
    }

    public function fireStation()
    {
        return $this->belongsTo(FireStation::class, 'idFireStation');
    }
}