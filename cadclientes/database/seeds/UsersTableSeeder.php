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
            'name' => 'Kabum Dev',
            'email' => 'lucas@me.com',
            'password' => Hash::make('123'),
        ]);
    }
}
