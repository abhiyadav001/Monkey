<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('order_details', function(Blueprint $table)
	    {
		$table->increments('id');
                $table->integer('order_id');
                $table->integer('medicine_id');
                $table->string('mrp');
                $table->string('quantity');                
                $table->string('prize');
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
