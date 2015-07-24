<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('bookings', function(Blueprint $table)
	    {
		$table->increments('id');
                $table->integer('vallet_id');
		$table->integer('req_car_type_id')->nullable();
                $table->integer('driver_id')->nullable();
                $table->string('starting_pt')->nullable();
                $table->string('end_pt')->nullable();
                $table->string('distance')->nullable();
		$table->string('charge_amount')->nullable();
                $table->string('guest_name')->nullable();
                $table->string('guest_address')->nullable();
                $table->string('guest_phone')->nullable();
                $table->string('guests_room')->nullable();
                $table->string('number_guests')->nullable();
                $table->enum('status', array('initiated', 'confirmed','picked','delivered','closed'))->nullable()->default('initiated');
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
