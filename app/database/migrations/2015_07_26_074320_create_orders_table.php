<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('orders', function(Blueprint $table)
	    {
		$table->increments('id');
                $table->integer('user_id');
                $table->enum('status', array('created','delivered','canceled','closed','panding'))->nullable()->default('created');
                $table->string('subtotal');
                $table->string('tax')->default('0');                
                $table->string('discount');
                $table->string('shipping_amount');
                $table->string('charged_amount');
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
