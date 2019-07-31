<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            'name' => 'Administrador',
            'label' => 'Administrador',
        ];

        DB::table('roles')->insert($role);
    }
}
