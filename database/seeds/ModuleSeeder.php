<?php

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    CONST MENU_ADMIN = 1;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = [
            'name' => 'Home',
            'description' => 'Home',
            'url' => 'admin',
            'icon' => 'minus-circle',
            'nick_name' => 'home',
            'menu_id' => self::MENU_ADMIN,
        ];

        DB::table('modules')->insert($module);

        $module = [
            'name' => 'Menus',
            'description' => 'Menus',
            'url' => 'admin/menus',
            'icon' => 'minus-circle',
            'nick_name' => 'menus',
            'menu_id' => self::MENU_ADMIN,
        ];

        DB::table('modules')->insert($module);

        $module = [
            'name' => 'Módulos',
            'description' => 'Módulos',
            'url' => 'admin/modules',
            'icon' => 'minus-circle',
            'nick_name' => 'modules',
            'menu_id' => self::MENU_ADMIN,
        ];

        DB::table('modules')->insert($module);

        $module = [
            'name' => 'Funções',
            'description' => 'Funções',
            'url' => 'admin/roles',
            'icon' => 'minus-circle',
            'nick_name' => 'roles',
            'menu_id' => self::MENU_ADMIN,
        ];

        DB::table('modules')->insert($module);

        $module = [
            'name' => 'Permissões',
            'description' => 'Permissões',
            'url' => 'admin/permissions',
            'icon' => 'minus-circle',
            'nick_name' => 'permissions',
            'menu_id' => self::MENU_ADMIN,
        ];

        DB::table('modules')->insert($module);

        $module = [
            'name' => 'Grupos',
            'description' => 'Grupos',
            'url' => 'admin/groups',
            'icon' => 'minus-circle',
            'nick_name' => 'groups',
            'menu_id' => self::MENU_ADMIN,
        ];

        DB::table('modules')->insert($module);

        $module = [
            'name' => 'Usuários',
            'description' => 'Usuários',
            'url' => 'admin/usuarios',
            'icon' => 'minus-circle',
            'nick_name' => 'users',
            'menu_id' => self::MENU_ADMIN,
        ];

        DB::table('modules')->insert($module);
    }
}
