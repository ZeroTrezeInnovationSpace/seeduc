<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rooms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 100)->nullable();
			$table->string('descripition', 50)->nullable();
			$table->string('capacity', 50)->nullable();
			$table->boolean('avaible_video_projector')->nullable()->default(0);
			$table->boolean('avaible_AC')->nullable()->default(0);
			$table->string('avaible_seats', 50)->nullable();
			$table->string('seats_type', 50)->nullable();
			$table->integer('location_id')->nullable()->index('rooms_fk_location');
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
		Schema::drop('rooms');
	}

}
