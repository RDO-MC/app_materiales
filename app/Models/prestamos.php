<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
   
    use HasFactory;
    protected $table = 'prestamos'; 
    protected $fillable = [
        'bienes_inmuebles_id',
        'bienes_muebles_id',
        'activos_nubes_id',
        'users_id',
        'lugar_de_prestamo',
        'fecha_de_prestamo',
        'estado',
        'notas',
        'fecha_de_devolucion',
        'observaciones',
        'status',
    ];

    public function bienes_muebles()
    {
        return $this->belongsTo(bienes_muebles::class, 'bienes_muebles_id');
    }

    public function bienes_inmuebles()
    {
        return $this->belongsTo(bienes_inmuebles::class, 'bienes_inmuebles_id');
    }

    public function user()
    {
        
        return $this->belongsTo(User::class, 'users_id');
    }
}