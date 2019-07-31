<?php

use Illuminate\Database\Seeder;

class AccessesSeeder extends Seeder
{
    private $permissions = [1, 2, 3, 4];

    private CONST ROLE_ID = 1;

    private $modules = [1, 2, 3, 4, 5, 6, 7];

    //nível de acesso
    private CONST NAO_DEFINIDO = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $permission) {
            foreach ($this->modules as $module) {
                $accesses = [
                    'role_id' => self::ROLE_ID,
                    'permission_id' => $permission,
                    'module_id' => $module,
                    'access_level_id' => self::NAO_DEFINIDO,
                ];

                DB::table('accesses')->insert($accesses);
            }
        }
    }
}
