<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permiso básico
        $viewDashboard = Permission::firstOrCreate(['name' => 'view dashboard']);

        // Rol admin (todos los permisos)
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        // Rol usuario (solo puede ver el dashboard)
        $usuario = Role::firstOrCreate(['name' => 'usuario']);
        $usuario->syncPermissions([$viewDashboard]);
    }
}
