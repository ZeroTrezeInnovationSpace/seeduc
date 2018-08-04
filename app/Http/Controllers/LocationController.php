<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
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
    		return view('location.index');    
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
    	return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$location = new Location;

    	$location->name = $request->input('name');
    	$location->postal_code = $request->input('postal_code');
    	$location->adress_number = $request->input('adress_number');
    	$location->adress_complement = $request->input('adress_complement');
    	$location->full_adress = $request->input('full_adress');
    	$location->district = $request->input('district');
    	$location->city = $request->input('city');
    	$location->state = $request->input('state');
    	$location->reference_point = $request->input('reference_point');
    	$location->work_days = $request->input('work_days');
    	$location->open_hours = $request->input('open_hours');
    	$location->Close_hour = $request->input('Close_hour');
    	$location->manager_name = $request->input('manager_name');
    	$location->manager_phone_number = $request->input('manager_phone_number');
    	$location->manager_email = $request->input('manager_email');
    	$location->save();

    	return redirect()->action('LocationController@create')->with('sucess', 'Cadastrado com sucesso!');;  
    }

    public function show($id)
    {        
    	return view('speaker.show', ['spekaer' => Speaker::with('activity')->find($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('speaker.manage', ['spekaer' => Speaker::with('activity')->find($id)]);
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

        $location = Location::find($id);
        $location->name = $request->input('name');
        $location->postal_code = $request->input('postal_code');
        $location->adress_number = $request->input('adress_number');
        $location->adress_complement = $request->input('adress_complement');
        $location->full_adress = $request->input('full_adress');
        $location->district = $request->input('district');
        $location->city = $request->input('city');
        $location->state = $request->input('state');
        $location->reference_point = $request->input('reference_point');
        $location->work_days = $request->input('work_days');
        $location->open_hours = $request->input('open_hours');
        $location->Close_hour = $request->input('Close_hour');
        $location->manager_name = $request->input('manager_name');
        $location->manager_phone_number = $request->input('manager_phone_number');
        $location->manager_email = $request->input('manager_email');

        $location->save();
        return redirect()->action('LocationController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$locations = Locations::findOrFail($id);
    	$locations->delete();

    	return redirect()->route('locations.index')->with('message', 'Lugar removida com sucesso!');
    }
}
