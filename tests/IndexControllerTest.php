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
             ->see('Incorrect Username or Password');
    }

}
