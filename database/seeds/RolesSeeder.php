<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\Models\User\Role();

        $role->name = 'Member';
        $role->guard_name = 'api';
        $role->save();

        $role = new \App\Models\User\Role();

        $role->name = 'Admin';
        $role->guard_name = 'api';
        $role->save();

        $role = new \App\Models\User\Role();

        $role->name = 'SuperAdmin';
        $role->guard_name = 'api';
        $role->save();
    }
}
