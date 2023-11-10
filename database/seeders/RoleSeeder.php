<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Role1 = Role::create(['name' => 'superadmin']);
        $Role2 = Role::create(['name' => 'administrativo']);
        $Role3 = Role::create(['name' => 'seguridad']);
        $Role4 = Role::create(['name' => 'comun']);

        //permisos

        Permission::create(['name' => 'home'])->syncRoles([$Role1,$Role2,$Role3,$Role4]);
       

        Permission::create(['name' => 'ver-usuarios'])->syncRoles([$Role1]);
        Permission::create(['name' => 'ver-materiales'])->syncRoles([$Role1]);
        Permission::create(['name' => 'ver-prestamos'])->syncRoles([$Role1,$Role3]);
        Permission::create(['name' => 'ver-asignados'])->syncRoles([$Role2]);
        Permission::create(['name' => 'ver-asignacion'])->syncRoles([$Role1]);
        Permission::create(['name' => 'ver-resguardos'])->syncRoles([$Role1]);
        Permission::create(['name' => 'ver-reportes'])->syncRoles([$Role1]);
       
        

    
    }
}
