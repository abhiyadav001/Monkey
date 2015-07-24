<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasscodeVerificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('passcode_verification', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('mobile_number');
            $table->string('passcode');
            $table->enum('verified_status', array('No', 'Yes'));
            $table->timestamps();
        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
