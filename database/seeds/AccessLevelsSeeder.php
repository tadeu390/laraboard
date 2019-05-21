<?php

use Illuminate\Database\Seeder;

class AccessLevelsSeeder extends Seeder
{
    public function run()
    {
        $access = ['name' => 'Desativado'];
        DB::table('access_levels')->insert($access);
		$access = ['name' => 'Não definido'];
        DB::table('access_levels')->insert($access);
        $access = ['name' => 'Todos'];
        DB::table('access_levels')->insert($access);
        $access = ['name' => 'Grupo'];
        DB::table('access_levels')->insert($access);
        $access = ['name' => 'Proprietário'];
		DB::table('access_levels')->insert($access);
	}

}
