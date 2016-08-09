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

    public function testLoginWithExistentUserCaseInsensitive()
    {
        $this->visit('/')
             ->type('UsEr@tWiLiO.cOm', 'email')
             ->type('password', 'password')
             ->press('Log in')
             ->see('You are logged in.');
    }

    public function testSignUpPage()
    {
        $this->visit('/')
             ->click('Sign up for an account here')
             ->see('Create an account');
    }

    public function testSignUpWithPasswordsNotMatching()
    {
        $this->visit('/sign-up/')
             ->type('newuser@twilio.com', 'email')
             ->type('password123', 'password1')
             ->type('password456', 'password2')
             ->press('create_account_btn')
             ->see('Passwords do not match.');
    }

    public function testSignUpWithExistentUser()
    {
        $this->visit('/sign-up/')
             ->type('user@twilio.com', 'email')
             ->type('password', 'password1')
             ->type('password', 'password2')
             ->press('create_account_btn')
             ->see('That email is already in use');
    }

    public function testSignUpWithNewUser()
    {
        $this->visit('/sign-up/')
             ->type('newuser@twilio.com', 'email')
             ->type('password', 'password1')
             ->type('password', 'password2')
             ->press('create_account_btn')
             ->see('You are logged in.');
    }

    public function testAccessUserPageWithoutCredentials()
    {
        $this->visit('/user/')
             ->see('Don\'t have an account?');
    }
}
