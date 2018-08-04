<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
    	//Se a pessoa for admin ou alguma perfil de organizador ela pode ver os eventos dela gerenciável
    	if(Auth::user()->hasRole('admin')){
    		return view('room.create');    
    	}//fazer else if para caso a pessoa tenha algum perfil de público que possa ver o evento não gerenciavel em seu feed
    	else{
    		return view('feed.index');    
    	}

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    	return view('room.create', ['locations' => Location::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$room = new Room;
    	$room->name = $request->input('name');
    	$room->descripition = $request->input('descripition');
    	$room->capacity = $request->input('capacity');
    	
    	
      $room->avaible_video_projector = $request->input('avaible_video_projector', 0);
      $room->avaible_AC = $request->input('avaible_AC', 0);      
      $room->avaible_seats = $request->input('avaible_seats');
      $room->seats_type = $request->input('seats_type');
      $room->location_id = $request->input('location_id');
      $room->save();

      return redirect()->action('RoomController@create')->with('sucess', 'Cadastrado com sucesso!');;  
  }

  public function show($id)
  {        
   return view('room.show', ['room' => Room::find($id)]);    
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('room.manage', ['room' => Room::find($id)]);
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

        $room = Room::find($id);
        $room->descripition = $request->input('descripition');
        $room->capacity = $request->input('capacity');
        $room->avaible_video_projector = $request->input('avaible_video_projector');
        $room->avaible_AC = $request->input('avaible_AC');
        $room->avaible_seats = $request->input('avaible_seats');
        $room->seats_type = $request->input('seats_type');
        $room->location_id = $request->input('location_id');
        $room->save();

        $room->save();
        return redirect()->action('RoomController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$room = Room::findOrFail($id);
    	$room->delete();

    	return redirect()->route('room.index')->with('message', 'Sala removida com sucesso!');
    }
}
