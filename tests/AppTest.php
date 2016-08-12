<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Otp\Otp;

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

    public function testLogout()
    {
        $this->visit('/')
             ->type('user@twilio.com', 'email')
             ->type('password', 'password')
             ->press('Log in')
             ->click('Log out')
             ->see('Don\'t have an account?');
    }

    public function testShowEnableTfaLinksAfterSignIn()
    {
        $this->visit('/')
             ->type('user@twilio.com', 'email')
             ->type('password', 'password')
             ->press('Log in')
             ->see('Enable SMS based authentication')
             ->see('Enable app based authentication');
    }

    public function testEnableTfaViaSmsJourney()
    {
        $otp = new Otp();
        $token = $otp->totp('R6LPJTVQXJFRYNDJ');

        // Login
        $this->visit('/')
             ->type('user@twilio.com', 'email')
             ->type('password', 'password')
             ->press('Log in');

         // Set up phone number
         $this->click('Enable SMS based authentication')
             ->type('+14155551212', 'phoneNumber')
             ->press('Submit and verify')
             ->see('An SMS has been sent');

         // Submit wrong token
         $this->type('-1', 'token')
             ->press('Submit and verify')
             ->see('Please try again.');

         // Submit correct token
         $this->type($token, 'token')
             ->press('Submit and verify')
             ->see('You are set up for Two-Factor Authentication via Twilio SMS!');
    }


    public function testEnableTfaViaAppJourney()
    {
        $otp = new Otp();
        $token = $otp->totp('R6LPJTVQXJFRYNDJ');

        // Login
        $this->visit('/')
             ->type('user@twilio.com', 'email')
             ->type('password', 'password')
             ->press('Log in');

        // Open Enable TFA Via App Page
        $this->click('Enable app based authentication')
             ->see('Enable Google Authenticator');

        // Submit wrong token
        $this->type('-1', 'token')
             ->press('Submit')
             ->see('Please try again');

        // Submit correct token
        $this->type($token, 'token')
             ->press('Submit')
             ->see('You are set up for Two-Factor Authentication via Google Authenticator!');
    }

    public function testEnableTfaVerifyWithOnlySmsEnabledJourney()
    {
        $otp = new Otp();

        // Login
        $this->visit('/')
             ->type('user.app_no.sms_yes@twilio.com', 'email')
             ->type('password', 'password')
             ->press('Log in')
             ->see('Account Verification')
             ->see('The SMS that was just sent to you');

        // Submit wrong token
        $this->type('-1', 'token')
             ->press('Submit')
             ->see('Please try again');

        // Submit correct token
        $token = $otp->totp('NVHWYJ4OV75YW3WC');
        $this->type($token, 'token')
             ->press('Submit')
             ->see('(Enabled for +14155551212)');
    }
}
