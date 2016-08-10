<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@twilio.com',
            'password' => bcrypt('password'),
            'totpSecret' => 'R6LPJTVQXJFRYNDJ'
        ]);
    }
}
