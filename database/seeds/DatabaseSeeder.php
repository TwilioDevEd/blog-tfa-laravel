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
                'password' => bcrypt('password'),
                'totpSecret' => 'R6LPJTVQXJFRYNDJ',
                'enableTfaViaSms' => false,
                'enableTfaViaApp' => false
            )
        );
        User::create(
            array(
                'name' => 'user.app_no.sms_yes',
                'email' => 'user.app_no.sms_yes@twilio.com',
                'password' => bcrypt('password'),
                'totpSecret' => 'NVHWYJ4OV75YW3WC',
                'phoneNumber' => '+14155551212',
                'enableTfaViaSms' => true,
                'enableTfaViaApp' => false
            )
        );

        User::create(
            array(
                'name' => 'user.app_yes.sms_no',
                'email' => 'user.app_yes.sms_no@twilio.com',
                'password' => bcrypt('password'),
                'totpSecret' => 'VRZQO34R4LHUH634',
                'enableTfaViaSms' => false,
                'enableTfaViaApp' => true
            )
        );

        User::create(
            array(
                'name' => 'user.app_yes.sms_yes',
                'email' => 'user.app_yes.sms_yes@twilio.com',
                'password' => bcrypt('password'),
                'totpSecret' => 'BOXB6K2SJCR5L7CR',
                'phoneNumber' => '+14155551213',
                'enableTfaViaSms' => true,
                'enableTfaViaApp' => true
            )
        );
    }
}
