<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function testIndex()
    {
        $this->visit('/')
             ->see('Don\'t have an account?');
    }

    public function testLoginWithNonExistentUser()
    {
        $this->post('/')
             ->see('Incorrect Email or Password');
    }

    public function testLoginWithExistentUserButWrongPassword()
    {
        $this->visit('/')
             ->type('user@twilio.com', 'email')
             ->type('wrongpassword', 'password')
             ->press('Log in')
             ->see('Incorrect Email or Password');
    }

    public function testLoginWithExistentUserAndCorrectPassword()
    {
        $this->visit('/')
             ->type('user@twilio.com', 'email')
             ->type('password', 'password')
             ->press('Log in')
             ->see('You are logged in.');
    }

    public function testLoginWithExistentUserCaseInsensitie()
    {
        $this->visit('/')
             ->type('UsEr@tWiLiO.cOm', 'email')
             ->type('password', 'password')
             ->press('Log in')
             ->see('You are logged in.');
    }
}
