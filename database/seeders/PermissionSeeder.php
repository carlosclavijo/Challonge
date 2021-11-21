<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolAdministrador = Role::create(['name' => 'Administrador']);
        $rolUsuariio = Role::create(['name' => 'Usuario']);

        $usuarioC = Permission::create(['name' => 'Crear Usuario']);
        $usuarioR = Permission::create(['name' => 'Ver Usuario']);
        $usuarioU = Permission::create(['name' => 'Editar Usuario']);
        $usuarioD = Permission::create(['name' => 'Eliminar Usuario']);

        $rolAdministrador->syncPermissions([$usuarioC->name, $usuarioR->name, $usuarioU->name, $usuarioD->name]);
    }
}
