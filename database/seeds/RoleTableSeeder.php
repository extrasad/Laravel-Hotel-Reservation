<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //    public function run()
        $role_admin_root = Role::create(['name' => 'Admin Root']);
        $role_admin_hotel = Role::create(['name' => 'Admin Hotel']);
        $role_recepcionista = Role::create(['name' => 'Recepcionista']);

        $permissions_root = [

            'role-list',
 
            'role-create',
 
            'role-edit',
 
            'role-delete',
 
            'auto-list',
 
            'auto-create',
 
            'auto-edit',
 
            'auto-delete',
 
            'habitacion-list',
 
            'habitacion-create',
 
            'habitacion-edit',
 
            'habitacion-delete',
 
            'cliente-list',
 
            'cliente-create',
 
            'cliente-edit',
 
            'cliente-delete',
 
            'reservacion-list',
 
            'reservacion-create',
 
            'reservacion-edit',
 
            'reservacion-delete',
 
            'producto-list',
 
            'producto-create',
 
            'producto-edit',
 
            'producto-delete',
 
            'consumo-list',
 
            'consumo-create',
 
            'consumo-edit',
 
            'consumo-delete',
 
            'empleado-list',
 
            'empleado-create',
 
            'empleado-edit',
 
            'empleado-delete',
 
            'turno-list',
 
            'turno-create',
 
            'turno-edit',
 
            'turno-delete',
 
         ];

         $permissions_recepcionista = [
 
            'auto-list',
 
            'auto-create',
 
            'auto-edit',
 
            'auto-delete',
 
            'habitacion-list',
 
            'habitacion-create',
 
            'habitacion-edit',
 
            'habitacion-delete',
 
            'cliente-list',
 
            'cliente-create',
 
            'cliente-edit',
 
            'cliente-delete',
 
            'reservacion-list',
 
            'reservacion-create',
 
            'reservacion-edit',
 
            'reservacion-delete',
 
            'producto-list',
 
            'producto-create',
 
            'producto-edit',
 
            'producto-delete',
 
            'consumo-list',
 
            'consumo-create',
 
            'consumo-edit',
 
            'consumo-delete',
 
         ];

         $permissions_hotel = [
 
            'auto-list',
 
            'auto-create',
 
            'auto-edit',
 
            'auto-delete',
 
            'habitacion-list',
 
            'habitacion-create',
 
            'habitacion-edit',
 
            'habitacion-delete',
 
            'cliente-list',
 
            'cliente-create',
 
            'cliente-edit',
 
            'cliente-delete',
 
            'reservacion-list',
 
            'reservacion-create',
 
            'reservacion-edit',
 
            'reservacion-delete',
 
            'producto-list',
 
            'producto-create',
 
            'producto-edit',
 
            'producto-delete',
 
            'consumo-list',
 
            'consumo-create',
 
            'consumo-edit',
 
            'consumo-delete',
 
            'empleado-list',
 
            'empleado-create',
 
            'empleado-edit',
 
            'empleado-delete',
 
            'turno-list',
 
            'turno-create',
 
            'turno-edit',
 
            'turno-delete',
 
         ];
        foreach ($permissions_root as $permission) {
            $role_admin_root->givePermissionTo($permission);
       }
       foreach ($permissions_recepcionista as $permission) {
            $role_recepcionista->givePermissionTo($permission);
       }
       foreach ($permissions_hotel as $permission) {
            $role_admin_hotel->givePermissionTo($permission);
       }  
    }
}
