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
        $permission = [
            'name' => 'CREATE',
            'label' => 'CREATE',
        ];
        DB::table('permissions')->insert($permission);

        $permission = [
            'name' => 'READ',
            'label' => 'READ',
        ];
        DB::table('permissions')->insert($permission);

        $permission = [
            'name' => 'UPDATE',
            'label' => 'UPDATE',
        ];
        DB::table('permissions')->insert($permission);

        $permission = [
            'name' => 'DELETE',
            'label' => 'DELETE',
        ];
        DB::table('permissions')->insert($permission);
    }
}
