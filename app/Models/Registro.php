<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
       
        'users_id',
        'fecha_hora',
        'direccion_ip',
        'exito',
      
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
