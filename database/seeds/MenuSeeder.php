<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            'name' => 'Admin',
            'description' => 'Admin',
            'icon' => 'tachometer-alt',
        ];

        DB::table('menus')->insert($menu);
    }
}
