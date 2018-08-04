<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = Event::where('id', 1)->first();
        if(is_null($events)){
           DB::table('events')->insert([
              'name' => '30ª Semana Da Educação',
              'descripition' => '30ª Semana Da Educação',
              'beginning_date'=> '2018-08-15',
              'end_date'=> '2018-08-17',
          ]);
       }
   }
}
