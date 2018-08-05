<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bond_id');
            $table->tinyInteger('professor');
            $table->tinyInteger('need_libras_interpreter');
            $table->tinyInteger('know_technology');
            $table->tinyInteger('used_to_sites');
            $table->tinyInteger('adept_qr_code');
            $table->tinyInteger('smartphone');
            $table->string('kind_professor');
            $table->string('professor_work_at');
            $table->string('city_professor_work_at');
            
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
        Schema::dropIfExists('quiz');
    }
}
