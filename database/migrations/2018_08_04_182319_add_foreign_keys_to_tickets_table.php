<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tickets', function(Blueprint $table)
		{
			$table->foreign('batches_id', 'tickets_ibfk_2')->references('id')->on('batches')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('events_id', 'tickets_ibfk_3')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tickets', function(Blueprint $table)
		{
			$table->dropForeign('tickets_ibfk_2');
			$table->dropForeign('tickets_ibfk_3');
		});
	}

}
