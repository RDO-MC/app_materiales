<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([ // Utiliza la clase completa con el namespace
            'nombre' => 'david',
            'a_paterno' => 'xochicale',
            'a_materno' => 'cueyactle',
            'num_empleado' => '98765',
            'telefono' => '2789634514',
            'cargo' => 'empleado',
            'campus' => 'zongolica',
            'email' => 'acdcdestruc@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])->assignRole('superadmin');

        }
}
