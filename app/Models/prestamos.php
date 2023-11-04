<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    protected $table = 'prestamos';
    use HasFactory;

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