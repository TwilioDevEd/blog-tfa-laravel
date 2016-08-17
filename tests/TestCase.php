<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('DB_CONNECTION=sqlite_test');

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $mockTwilioClient = Mockery::mock(\Twilio\Rest\Client::class)->makePartial();
        $mockTwilioClient->messages = Mockery::mock();
        $twilioNumber = config('services.twilio')['number'];
        $mockTwilioClient->messages->shouldReceive('create');
        $app->instance(\Twilio\Rest\Client::class, $mockTwilioClient);
        
        return $app;
    }
}
