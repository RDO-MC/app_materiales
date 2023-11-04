<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignaciones'; 
    protected $fillable = [
        'bienes_inmuebles_id',
        'bienes_muebles_id',
        'activos_nubes_id',
        'autorizo',
        'users_id',
        'fecha_de_asignacion',
        'origen_salida',
        'lugar_asignacion',
        'estado',
        'notas',
        'fecha_de_devolucion',
        'observaciones',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function bienesInmuebles()
    {
        return $this->belongsTo(BienesInmuebles::class, 'bienes_inmuebles_id');
    }
    
}
