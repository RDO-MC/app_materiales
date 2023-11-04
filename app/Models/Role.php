<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends SpatieRole
{
    
    protected $table = 'roles'; // Nombre de la tabla de roles en la base de datos

    protected $fillable = [
        'name', 'web', // Añade aquí todos los campos que puedas llenar
    ];

    // Si deseas establecer relaciones con otros modelos, puedes hacerlo aquí.
    // Por ejemplo, si quieres una relación muchos a muchos con usuarios:
    
    public function roles()
{
    return $this->belongsToMany('App\User'); // Asegúrate de que el nombre de la tabla 'roles' sea correcto
}

}

