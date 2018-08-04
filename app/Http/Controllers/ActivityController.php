<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Event;
use App\Location;
use App\Speaker;
use App\Subscription;
use App\Bond;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
    	//Se a pessoa for admin ou alguma perfil de organizador ela pode ver os eventos dela gerenciável
    	/*if(Auth::user()->hasRole('admin')){
    		return view('activity.index');    
    	}//fazer else if para caso a pessoa tenha algum perfil de público que possa ver o evento não gerenciavel em seu feed
    	else{
    		return view('feed.index');    
    	}*/

       return view('activity.index', ['activities' => Activity::with('event', 'subscribers')->get(),
           'subscriptions' => Subscription::all()->where('user_id', $request->session()->get('id'))])
       ->with('id', $request->session()->get('id'))
       ->with('name', $request->session()->get('name'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity.create', ['events' => Event::all(), 'locations' => Location::all(), 
            'speakers' => Speaker::all(), 'bonds' => Bond::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$activity = new Activity;

    	$activity->name = $request->input('name');
    	$activity->description = $request->input('description');
        $activity->beginning_date = $request->input('beginning_date');
        $activity->period = $request->input('period');
        $activity->minimum_quorum = $request->input('minimum_quorum');
        $activity->maximum_capacity = $request->input('maximum_capacity');
        $activity->event_id = $request->input('event_id');
        $activity->location_id = $request->input('location_id');
        $activity->public_id = $request->input('public_id');
    	//$activity->program_id = $request->input('program_id');
    	
    	$activity->save();
    	return redirect()->action('ActivityController@create')->with('sucess', 'Cadastrado com sucesso!');;  
    }

    public function show($id)
    {        
    	return view('activity.show', ['activity' => Activity::with('event', 'location', 'public', 'program')->find($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('activity.manage', ['activity' => Activity::with('event', 'location', 'public', 'program')->find($id), 'batches' => Batch::where('activity_id', $id)->orderBy('created_at', 'desc')->get(), 'activityId' => $id]);
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

        $activity = Activity::find($id);
        $activity->name = $request->input('name');
        $activity->event_id = $request->input('event_id');
        $activity->location_id = $request->input('location_id');
        $activity->public_id = $request->input('public_id');
        $activity->program_id = $request->input('program_id');

        $activity->save();
        return redirect()->action('ActivityController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$activity = Activity::findOrFail($id);
    	$activity->delete();

    	return redirect()->route('activity.index')->with('message', 'Atividade removida com sucesso!');
    }

}
