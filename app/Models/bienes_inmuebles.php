<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bienes_inmuebles extends Model
{
    use HasFactory;
    protected $fillable = [
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

}
