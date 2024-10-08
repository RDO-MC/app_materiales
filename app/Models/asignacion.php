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

  
    
    public function bienes_inmuebles()
    {
        return $this->belongsTo(bienes_inmuebles::class, 'bienes_inmuebles_id');
    }
    public function bienesMuebles()
    {
        return $this->belongsTo(bienes_muebles::class, 'bienes_muebles_id');
    }
    public function activosNubes()
    {
        return $this->belongsTo(activos_nube::class, 'activos_nubes_id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'users_id');
}


public function prestamos() 
{
    return $this->hasMany(prestamos::class, 'bienes_muebles_id')
        ->orWhere('bienes_inmuebles_id', '!=', null)
        ->orWhere('activos_nubes_id', '!=', null);
}


}
