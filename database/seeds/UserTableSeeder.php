<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin Root';
        $user->username = 'admin_root';
        $user->password = bcrypt('Admin_root_123');
        $user->save();
        $user->assignRole('Admin Root');

        $recepcionista = new User();
        $recepcionista->name = 'Jon Snow';
        $recepcionista->username = 'recep';
        $recepcionista->password = bcrypt('1234');
        $recepcionista->save();
        $recepcionista->assignRole('Recepcionista');
    }
}
