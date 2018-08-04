<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use Auth;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
    	//Se a pessoa for admin ou alguma perfil de organizador ela pode ver os eventos dela gerenciável
    	/*if(Auth::user()->hasRole('admin')){
    		return view('event.index');    
    	}
    	else{
    		return view('feed.index');    
    	}*/

        return view('event.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $event = new Event;

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
    	return view('event.show', ['event' => Event::with('eventType', 'schedules', 'user')->find($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('event.manage', ['event' => Event::with('eventType','schedules', 'user')->find($id), 'schedules' => Schedule::where('event_id', $id)->orderBy('created_at', 'desc')->get(), 'eventId' => $id]);
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

        $event = Event::find($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('event.index')->with('message', 'Evento removido com sucesso!');
    }

}
