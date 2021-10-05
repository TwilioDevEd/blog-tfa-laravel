<a href="https://www.twilio.com">
  <img src="https://static0.twilio.com/marketing/bundles/marketing/img/logos/wordmark-red.svg" alt="Twilio" width="250" />
</a>

# Blog TFA Post - PHP/Laravel

[![Build Status](https://travis-ci.org/TwilioDevEd/blog-tfa-laravel.svg?branch=master)](https://travis-ci.org/TwilioDevEd/blog-tfa-laravel)

### Prerequisites

1. [PHP](http://php.net/)
1. [Laravel](https://laravel.com)
1. A Twilio account with a verified [phone number](https://www.twilio.com/console/phone-numbers/incoming). (Get a
   [free account](https://www.twilio.com/try-twilio?utm_campaign=tutorials&utm_medium=readme)
   here.) If you are using a Twilio Trial Account, you can learn all about it
   [here](https://www.twilio.com/help/faq/twilio-basics/how-does-twilios-free-trial-work).


### Local Development

1. First clone this repository and `cd` into it.

   ```bash
   git clone git@github.com:TwilioDevEd/blog-tfa-laravel.git
   cd blog-tfa-laravel
   ```

1. Copy the sample configuration file and edit it to match your configuration.

    ```bash
    cp .env.example .env
    ```

    You can find your `TWILIO_ACCOUNT_SID` and `TWILIO_AUTH_TOKEN` in your
    [Twilio Account Settings](https://www.twilio.com/user/account/settings).
    You will also need a `TWILIO_NUMBER`, which you may find [here](https://www.twilio.com/user/account/phone-numbers/incoming).

1. Install dependencies.

    ```bash
    composer install
    ```

1. Create the sqlite database.

    ```bash
    php TouchDatabase.php
    ```

1. Generate an APP_KEY.

    ```bash
    php artisan key:generate
    ```

1. Run the migrations.

   ```bash
   php artisan migrate
   DB_CONNECTION=sqlite_test php artisan migrate
   ```

1. Make sure the tests succeed.

   ```bash
   ./vendor/bin/phpunit
   ```

1. Run the application.

   ```bash
   php artisan serve
   ```

## Meta

* No warranty expressed or implied. Software is as is. Diggity.
* [MIT License](http://www.opensource.org/licenses/mit-license.html)
* Lovingly crafted by Twilio Developer Education.