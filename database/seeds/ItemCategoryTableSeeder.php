<?php

use Illuminate\Database\Seeder;

class ItemCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            'name' => 'Stationary Supply',
            'name' => 'Computer Supply',
            'name' => 'Canteen Supply'
        ]);
    }
}
