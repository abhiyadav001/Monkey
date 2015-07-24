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
                $table->enum('type', array('driver', 'valet','admin'))->nullable()->default('driver');
                $table->string('passcode');
		$table->string('password')->nullable();
                $table->integer('car_type_id')->nullable();
                $table->string('unit_charge')->nullable();
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->string('access_token')->nullable();
                $table->string('refresh_token')->nullable();
                $table->enum('status', array('active', 'inactive','deleted'))->nullable()->default('inactive');
                $table->enum('duty_status', array('on-duty', 'off-duty'))->nullable()->default('on-duty');
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
