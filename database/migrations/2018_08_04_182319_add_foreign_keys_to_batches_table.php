<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('batches', function(Blueprint $table)
		{
			$table->foreign('user_id', 'batches_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('activity_id', 'batches_ibfk_2')->references('id')->on('activities')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('batches', function(Blueprint $table)
		{
			$table->dropForeign('batches_ibfk_1');
			$table->dropForeign('batches_ibfk_2');
		});
	}

}
