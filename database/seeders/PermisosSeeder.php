<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // creamos los roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleOpeador = Role::create(['name' => 'operador']);

        // creamos los permisos

        $permission = Permission::create(['name' => 'crear tipo_Cambio']);
        $permission = Permission::create(['name' => 'listar tipo_Cambio']);
        $permission = Permission::create(['name' => 'editar tipo_Cambio']);
        $permission = Permission::create(['name' => 'borrar tipo_Cambio']);

        // asignamos permisos a los roles
        $roleAdmin->givePermissionTo('crear tipo_Cambio');
        $roleAdmin->givePermissionTo('listar tipo_Cambio');
        $roleAdmin->givePermissionTo('editar tipo_Cambio');
        $roleAdmin->givePermissionTo('borrar tipo_Cambio');

        $roleOpeador->givePermissionTo('listar tipo_Cambio');

    }
}
