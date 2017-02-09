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
        DB::table('users')->insert([
            'name' => 'JohnDoe',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('secret')
        ]);
    }
}
