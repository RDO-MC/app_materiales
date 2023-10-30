<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bienes_muebles extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'cve_conac',
        'cve_inventario_sefiplan',
        'cve_inventario_interno',
        'nombre',
        'descripcion',
        'factura',
        'num_serie',
        'importe',
        'partida',
        'identificacion_del_bien',
        'marca',
        'modelo',
        'img_url',
        'qr',
        'nota',
        'estado',
        'status',
    ];
}
