<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('users', function(Blueprint $table)
	    {
		$table->increments('id');
		$table->string('mobile_number')->unique();
                $table->string('password')->nullable();
                $table->string('full_name');
                $table->string('email');
                $table->enum('type', array('user','admin'))->nullable()->default('user');
                $table->string('passcode');		
                $table->enum('status', array('active', 'inactive','deleted'))->nullable()->default('inactive');
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
