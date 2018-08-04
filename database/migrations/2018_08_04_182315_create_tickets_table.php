<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->string('name', 50)->nullable();
			$table->integer('id', true);
			$table->string('creation_date', 50)->nullable();
			$table->string('creation_hour', 50)->nullable();
			$table->string('price', 50)->nullable();
			$table->string('descripition', 50)->nullable();
			$table->integer('publics_id')->nullable()->index('publics_id');
			$table->integer('batches_id')->nullable()->index('batches_id');
			$table->integer('events_id')->nullable()->index('events_id');
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
		Schema::drop('tickets');
	}

}
