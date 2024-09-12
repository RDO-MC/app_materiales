<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\asignacion;

class bienes_inmuebles extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha', 
        'nombre',
        'descripcion',
        'num_escritura_propiedad',
        'ins_reg_pub_prop',
        'estado_valuado',
        'registro_contable',
        'num_cedula_catastral',
        'val_catastral',
        'val_comercial',
        'img_url',
        'qr',
        'estado',
        'nota',
        'status',

    ];

    public function prestamo()
    {
        return $this->hasOne(prestamos::class, 'bienes_inmuebles_id');
    }
    public function asignacion()
    {
        return $this->hasOne(asignacion::class, 'bienes_inmuebles_id');
    }
    
}
