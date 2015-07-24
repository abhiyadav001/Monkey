<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('car_types', function(Blueprint $table)
	    {
		$table->increments('id');
                $table->integer('name');
                $table->string('img_hash')->nullable();
                $table->enum('status', array('active', 'inactive'))->nullable()->default('active');
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
