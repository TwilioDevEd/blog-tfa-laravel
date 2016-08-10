<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTfaColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('phoneNumber')->nullable();
            $table->boolean('enableTfaViaSms')->default(false);
            $table->boolean('enableTfaViaApp')->default(false);
            $table->string('totpSecret')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function ($table) {
        //     $table->dropColumn('phoneNumber');
        //     $table->dropColumn('enableTfaViaSms');
        //     $table->dropColumn('enableTfaViaApp');
        // });
    }
}
