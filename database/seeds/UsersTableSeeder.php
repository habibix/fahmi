<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
            ],[
                'name' => 'Member',
                'email' => 'member@mail.com',
                'password' => bcrypt('password'),
            ]
        ];

        DB::table('users')->insert($user);
    }
}
