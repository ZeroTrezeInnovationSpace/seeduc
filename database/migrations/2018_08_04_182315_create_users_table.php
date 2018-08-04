<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->string('name', 50)->nullable();
			$table->integer('id', true);
			$table->integer('role_id')->nullable();
			$table->string('user_picture', 150)->nullable();
			$table->string('email', 50)->nullable();
			$table->string('phone_number', 50)->nullable();
			$table->boolean('avaible_whatsapp')->nullable();
			$table->string('linkedin', 50)->nullable();
			$table->string('facebook', 50)->nullable();
			$table->string('twitter', 50)->nullable();
			$table->string('postal_code', 10)->nullable();
			$table->string('adress_number', 10)->nullable();
			$table->string('adress_complement', 10)->nullable();
			$table->string('full_adress', 50)->nullable();
			$table->string('district', 50)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->integer('users_creator_id')->nullable();
			$table->timestamps();
			$table->string('password')->nullable();
			$table->string('CPF', 11)->nullable()->unique('CPF');
			$table->string('register_id', 10)->nullable()->unique('register_id');
			$table->string('second_register_id', 10)->nullable()->unique('second_register_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
