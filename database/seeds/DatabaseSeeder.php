<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            array(
                'name' => 'user',
                'email' => 'user@twilio.com',
                'password' => bcrypt('password')
            )
        );
    }
}
