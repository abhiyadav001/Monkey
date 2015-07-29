<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('app_settings', function(Blueprint $table)
	    {
		$table->increments('id');
                $table->string('location');
                $table->string('status')->nullable()->default('Active');
                $table->string('quick_delivery_status')->nullable()->default('On');
                $table->string('discount_percent');
                $table->string('min_order');
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
