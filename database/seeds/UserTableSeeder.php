<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'kwen',
            'email' => 'email@email.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'kwen1',
            'email' => 'email1@email.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
