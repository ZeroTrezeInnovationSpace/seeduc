<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->string('name', 50)->nullable();
			$table->integer('id', true);
			$table->string('descripition', 50)->nullable();
			$table->date('beginning_date')->nullable();
			$table->date('end_date')->nullable();
			$table->integer('event_type_id')->nullable()->index('event_type_id');
			$table->integer('public_id')->nullable()->index('public_id');
			$table->integer('user_id')->nullable()->index('user_id');
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
		Schema::drop('events');
	}

}
