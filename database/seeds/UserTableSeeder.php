<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints

        factory('AGStore\User')->create([
            'name' => 'Alexandre Gomes',
            'email' => 'agomespb@gmail.com',
            'password' => bcrypt(123456),
            'is_admin' => 1,
            'remember_token' => bcrypt(str_random(10)),
        ]);

        factory('AGStore\User')->create([
            'name' => 'Jaqueline Veras',
            'email' => 'jackmodaintimacombr@gmail.com',
            'password' => bcrypt(123456),
            'is_admin' => 0,
            'remember_token' => bcrypt(str_random(10)),
        ]);

        factory('AGStore\User')->create([
            'name' => 'AG3W Web Service',
            'email' => 'ag3wcombr@gmail.com',
            'password' => bcrypt(123456),
            'is_admin' => 0,
            'remember_token' => bcrypt(str_random(10)),
        ]);

    }
}