<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\asignacion;

class activos_nube extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_adquisicion',
        'fecha_vencimiento',
        'version',
      
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

   
    public function prestamo()
    {
        return $this->hasOne(prestamos::class, 'activos_nubes_id');
    }
    public function asignacion()
{
    return $this->hasOne(asignacion::class, 'activos_nubes_id');
}

}
