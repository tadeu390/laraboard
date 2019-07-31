<?php

use Illuminate\Database\Seeder;

class GroupRoleSeeder extends Seeder
{
    private CONST GRUPO = 1;
    private CONST ROLE = 1;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupRole = [
            'group_id' => self::GRUPO,
            'role_id' => self::ROLE,
        ];

        DB::table('group_role')->insert($groupRole);
    }
}
