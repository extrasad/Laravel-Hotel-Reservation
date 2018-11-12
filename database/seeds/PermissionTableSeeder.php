<?php


use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

       $permissions = [

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

           'tarifario-list',

           'tarifario-create',

           'tarifario-edit',

           'tarifario-delete',

        ];


        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }

    }

}