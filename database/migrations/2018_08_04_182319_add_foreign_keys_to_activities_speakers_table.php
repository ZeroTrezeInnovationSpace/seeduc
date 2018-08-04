<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActivitiesSpeakersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activities_speakers', function(Blueprint $table)
		{
			$table->foreign('activity_id', 'fk_activity_id')->references('id')->on('activities')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('speaker_id', 'fk_speaker_id')->references('id')->on('speakers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activities_speakers', function(Blueprint $table)
		{
			$table->dropForeign('fk_activity_id');
			$table->dropForeign('fk_speaker_id');
		});
	}

}
