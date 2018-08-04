<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitiesSpeakersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities_speakers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('activity_id')->nullable()->index('fk_activity_id');
			$table->integer('speaker_id')->nullable()->index('fk_speaker_id');
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
		Schema::drop('activities_speakers');
	}

}
