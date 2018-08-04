<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('batches', function(Blueprint $table)
		{
			$table->string('name', 50)->nullable();
			$table->integer('id', true);
			$table->string('beginning_date', 50)->nullable();
			$table->string('beginning_hour', 50)->nullable();
			$table->string('end_date', 50)->nullable();
			$table->string('end_hour', 50)->nullable();
			$table->string('min_tickets', 50)->nullable();
			$table->string('max_tickets', 50)->nullable();
			$table->integer('activity_id')->index('batches_ibfk_2');
			$table->integer('user_id')->index('activity_id');
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
		Schema::drop('batches');
	}

}
