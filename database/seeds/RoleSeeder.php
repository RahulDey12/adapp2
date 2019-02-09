<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role for admin
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->save();

        //Role for subscriber
        $role_subs = new Role();
        $role_subs->name = 'subscriber';
        $role_subs->save();

        //Role for advertiser
        $role_subs = new Role();
        $role_subs->name = 'advertiser';
        $role_subs->save();
    }
}
