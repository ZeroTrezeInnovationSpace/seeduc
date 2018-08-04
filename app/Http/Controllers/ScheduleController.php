<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auth;
use App\Schedule;

class ScheduleController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)//Id do evento
    {   
    	return view('schedule.index', ['shedules' => Schedule::with('programs','programs.activities','event.user')->where('event_id',$id)->get()]);   
    }
    // A view irá receber o calendário e o usuários, vamos fazer um if que irá determinar o que aparece para cada user.


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shedule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $event = new Shedule;

        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->hour = $request->input('hour');

        $event->minimum_quorum = $request->input('minimum_quorum');
        $event->max_capacity = $request->input('max_capacity');   

        //$event->user_id = $request->input('user_id');
        //tipo_evento_id
        //user_id
        //publico_id    
        $event->save();
        return redirect()->action('EventController@index');  
    }

    public function show($id)
    {        
    	return view('shedule.show', ['shedule' => Shedule::with('programs', 'event', 'event.user')->find($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('event.manage', ['event' => Event::with('programs', 'event', 'event.user')->find($id), 'programs' => Program::where('schedule_id', $id)->orderBy('created_at', 'desc')->get(), 'scheduleId' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'. $id .'|max:255',
        ]);*/

        $schedule = Schedule::find($id);
        $schedule->name = $request->input('name');
        $schedule->description = $request->input('description');
        $schedule->date = $request->input('date');
        $schedule->hour = $request->input('hour');
        $schedule->minimum_quorum = $request->input('minimum_quorum');
        $schedule->max_capacity = $request->input('max_capacity');   
        //$schedule->user_id = $request->input('user_id');
        //tipo_scheduleo_id
        //user_id
        //publico_id    
        $schedule->save();
        return redirect()->action('scheduleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedule.index')->with('message', 'Agenda removida com sucesso!');
    }
}
