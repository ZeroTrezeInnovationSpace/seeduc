<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpeakersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('speakers', function(Blueprint $table)
		{
			$table->string('name', 50)->nullable();
			$table->integer('id', true);
			$table->string('type', 50)->nullable();
			$table->string('linkedin', 50)->nullable();
			$table->string('facebook', 50)->nullable();
			$table->string('twitter', 50)->nullable();
			$table->text('small_desc', 65535)->nullable();
			$table->string('picture', 500)->nullable();
			$table->string('website', 100)->nullable();
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
		Schema::drop('speakers');
	}

}
