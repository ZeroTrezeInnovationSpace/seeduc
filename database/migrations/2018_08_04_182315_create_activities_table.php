<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function(Blueprint $table)
		{
			$table->string('name', 50)->nullable();
			$table->integer('id', true);
			$table->string('description')->nullable();
			$table->date('beginning_date')->nullable();
			$table->string('period', 50)->nullable();
			$table->integer('minimum_quorum')->nullable();
			$table->integer('maximum_capacity')->nullable();
			$table->integer('event_id')->nullable()->index('event_id');
			$table->integer('location_id')->nullable()->index('location_id');
			$table->integer('public_id')->nullable()->index('public_id');
			$table->integer('program_id')->nullable();
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
		Schema::drop('activities');
	}

}
