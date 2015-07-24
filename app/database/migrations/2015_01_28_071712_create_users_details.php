<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('users_details', function(Blueprint $table)
	    {
		$table->increments('id');
                $table->integer('user_id');
		$table->string('first_name');
                $table->string('last_name');
                $table->string('address');
                $table->string('licence')->nullable();
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
