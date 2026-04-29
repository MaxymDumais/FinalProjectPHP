<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'intervention_types';

    protected $fillable = [
        'interventionNumber',
        'description'
    ];

    public function interventionFiles()
    {
        return $this->hasMany(InterventionFile::class);
    }
}