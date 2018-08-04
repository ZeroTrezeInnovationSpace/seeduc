<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('events')->insert([
    		'name' => '30ª Semana Da Educação',
    		'descripition' => '30ª Semana Da Educação',
    		'beginning_date'=> '2018-08-15',
    		'end_date'=> '2018-08-17',
    	]);
    }
}
