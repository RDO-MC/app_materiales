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
    }
}
