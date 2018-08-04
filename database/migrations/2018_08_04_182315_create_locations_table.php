<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->string('name', 50)->nullable();
			$table->integer('id', true);
			$table->string('postal_code', 10)->nullable();
			$table->string('adress_number', 10)->nullable();
			$table->string('adress_complement', 10)->nullable();
			$table->string('full_adress', 50)->nullable();
			$table->string('district', 50)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->string('reference_point', 50)->nullable();
			$table->string('work_days', 50)->nullable();
			$table->time('open_hours')->nullable();
			$table->time('Close_hour')->nullable();
			$table->string('manager_name', 50)->nullable();
			$table->string('manager_phone_number', 50)->nullable();
			$table->string('manager_email', 50)->nullable();
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
		Schema::drop('locations');
	}

}
