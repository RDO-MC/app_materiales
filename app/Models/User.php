<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
//use HasRoles;
class User extends Authenticatable
{
    use HasRoles;
    protected $guard_name = 'web';
    use Notifiable, HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    public function getEmailAttribute($value) {
        return $value;
      }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'a_paterno',
        'a_materno',
        'num_empleado',
        'telefono',
        'cargo',
        'campus',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'user_id');
    }
}
