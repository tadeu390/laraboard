<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = [
            'name' => 'Administrador',
            'description' => 'Administrador',
        ];

        DB::table('groups')->insert($group);
    }
}
