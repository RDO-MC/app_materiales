<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actividades extends Model
{
    
   
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
       
        'registros_id',
        'actividad',
        'fecha_hora',
        
      
    ];
    public function actividades()
    {
        return $this->hasMany(Actividades::class, 'registros_id');
    }
}
