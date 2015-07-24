<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
        
        public function up()
	{
	    Schema::create('notifications', function(Blueprint $table)
	    {
		$table->increments('id');
                $table->integer('booking_id');
		$table->string('contant')->unique();
                $table->enum('type', array('for_booking', 'confirmed_booking'));
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
