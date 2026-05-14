<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
//The class of the grade
class Grade extends Model
{
    use HasFactory;
 
    public $timestamps = false;
 
    //The table linked to the grade
    protected $table = 'grades';
 
    //The attributes of the grade
    protected $fillable = [
        'id', 
        'description' 
    ];
 
    //Link to the firefighters
    public function fireFighter()
    {
        return $this->hasMany(FireFighter::class);
    }
}