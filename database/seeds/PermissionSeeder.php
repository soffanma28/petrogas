<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->insert([
            'name' => 'Request Supply',
            'guard_name' => 'backpack',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Approve Supply',
            'guard_name' => 'backpack',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Request Admin',
            'guard_name' => 'backpack',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Approve Admin',
            'guard_name' => 'backpack',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Complete Admin',
            'guard_name' => 'backpack',
        ]);
    }
}
