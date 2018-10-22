<?php

use Illuminate\Database\Seeder;
use App\Role;

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
        $role = new Role();
        $role->name = 'Admin Root';
        $role->description = 'Administrador total de la aplicación.';
        $role->save();

        $role = new Role();
        $role->name = 'Admin Recepcionista';
        $role->description = 'Administrador recepcionista.';
        $role->save();

        $role = new Role();
        $role->name = 'Admin Hotel';
        $role->description = 'Administrador Hotel.';
        $role->save();
    }
}
