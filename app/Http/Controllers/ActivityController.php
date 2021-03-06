<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Event;
use App\Location;
use App\Speaker;
use App\Subscription;
use App\Bond;
use App\Room;
use DB;

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

     return view('activity.index', ['activities' => Activity::with('event', 'subscribers', 'location', 'bond', 'room')
        //->whereIn('bond_id', [$request->session()->get('bond_id'),1,2, 3])
        ->orderBy('beginning_date', 'asc')
        ->paginate(10),
        'search_key' => $request->input('search_key'),
        'subscriptions' => Subscription::all()->where('user_id', $request->session()->get('id'))])
     ->with('id', $request->session()->get('id'))
     ->with('bond_id', $request->session()->get('bond_id'))
     ->with('name', $request->session()->get('name'));
 }

   public function searchActivity(Request $request)
    {

     $activities = Activity::with('event', 'subscribers', 'location', 'bond', 'room')
        ->where('name', 'like', '%' . $request->input('search_key') . '%')   
        //->whereIn('bond_id', [$request->session()->get('bond_id'),1,2,3])
        ->orderBy('beginning_date', 'asc')
        ->paginate(10)
        ->appends(['search_key' => $request->input('search_key')]);


      return view('activity.index', ['activities' => $activities, 'search_key' => $request->input('search_key'),
        'subscriptions' => Subscription::all()->where('user_id', $request->session()->get('id'))])
     ->with('id', $request->session()->get('id'))
     ->with('bond_id', $request->session()->get('bond_id'))
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
            'speakers' => Speaker::orderBy('name', 'asc')->get(), 'bonds' => Bond::all(), 
            'rooms' => Room::select("rooms.*"
                ,DB::raw("CONCAT(locations.name,' ',rooms.name) as full_name"))
            ->join("locations", "rooms.location_id", "=", "locations.id")
            ->get()]);
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
        $activity->bond_id = $request->input('public_id');
        $activity->room_id = $request->input('room');
    	//$activity->program_id = $request->input('program_id');

        $activity->save();
        return redirect()->action('ActivityController@create')->with('sucess', 'Cadastrado com sucesso!');;  
    }

    #LISTAR PARA ADMINISTRADOR OS EVENTOS
    public function show()
    {        
        return view('activity.list', ['activities' => Activity::with('event', 'subscribers', 'location', 'bond')
            ->orderBy('beginning_date', 'asc')
            ->paginate(10),
            'subscriptions' => Subscription::all()]);
        // return view('activity.show', ['activity' => Activity::with('event', 'location', 'room', 'bond', 'speakers')]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage(Request $request)
    {
        $id = $request->input('activity_id');
        return view('activity.manage', ['activity' => Activity::with('event', 'location', 'bond')->find($id), 'events' => Event::all(), 'locations' => Location::all(), 
            'speakers' => Speaker::orderBy('name', 'asc')->get(), 'bonds' => Bond::all(), 
            'rooms' => Room::select("rooms.*"
                ,DB::raw("CONCAT(locations.name,' ',rooms.name) as full_name"))
            ->join("locations", "rooms.location_id", "=", "locations.id")
            ->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*echo '<br>';
        print_r($request->speakers);
        print_r($request->speakers[0]);
        exit;*/
        /*$this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'. $id .'|max:255',
        ]);*/
        
        $activity = Activity::find($request->input('id'));
        $activity->room_id = $request->input('room_id');
        $activity->name = $request->input('name');
        $activity->description = $request->input('description');
        $activity->beginning_date = $request->input('beginning_date');
        $activity->period = $request->input('period');
        $activity->minimum_quorum = $request->input('minimum_quorum');
        $activity->maximum_capacity = $request->input('maximum_capacity');
        $activity->event_id = $request->input('event_id');
        $activity->location_id = $request->input('location_id');
        //$activity->bond_id = $request->input('bonds');
        $activity->description_speaker = $request->input('description_speaker');

        $activity->save();
        return redirect()->action('ActivityController@show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('activity_id');
        $activity = Activity::findOrFail($id);
        
        $activity->delete();

        return redirect()->action('ActivityController@show')
        ->with('message', 'Atividade removida com sucesso!');
    }

}
