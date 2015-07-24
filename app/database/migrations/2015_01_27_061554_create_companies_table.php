<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('companies', function(Blueprint $table)
	    {
		$table->increments('id');
		$table->string('code')->unique();
		$table->string('name');
                $table->string('owner_name');
		$table->string('address');
		$table->string('licence')->nullable();
                $table->enum('status', array('active', 'inactive','deleted'))->nullable()->default('active');
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
