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
        $role_admin_root = Role::where('name', 'Admin Root')->first();
        $role_admin_recepcionista = Role::where('name', 'Admin Recepcionista')->first();
        $role_admin_hotel = Role::where('name', 'Admin Hotel')->first();

        $user = new User();
        $user->name = 'Admin Root';
        $user->username = 'admin_root';
        $user->password = bcrypt('Admin_root_123');
        $user->save();
        $user->roles()->attach($role_admin_root);

        $user = new User();
        $user->name = 'Admin Recepcionista';
        $user->username = 'admin_recepcionista';
        $user->password = bcrypt('Admin_recepcionista_123');
        $user->save();
        $user->roles()->attach($role_admin_recepcionista);

        $user = new User();
        $user->name = 'Admin Hotel';
        $user->username = 'admin_hotel';
        $user->password = bcrypt('Admin_hotel_123');
        $user->save();
        $user->roles()->attach($role_admin_hotel);
    }
}
