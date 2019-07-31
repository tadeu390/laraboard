<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    CONST USER_GROUP = 1;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Tadeu',
            'email' => 'tadeu.390@gmail.com',
            'password' => '$2y$10$niQcXIvjiSyFCZznku4QDeYO/6FyddkBF/VoEUr7IQy6RkjLMdDgC',
            'group_id' => self::USER_GROUP,
        ];

        DB::table('users')->insert($user);
    }
}
