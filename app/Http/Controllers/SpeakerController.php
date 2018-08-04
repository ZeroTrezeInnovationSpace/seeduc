<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Speaker;

class SpeakerController extends Controller
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
    		return view('speaker.index');    
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
    	return view('speaker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$speaker = new Speaker;

    	$speaker->name = $request->input('name');
    	$speaker->type = $request->input('type');
    	$speaker->linkedin = $request->input('linkedin');
    	$speaker->facebook = $request->input('facebook');
    	$speaker->twitter = $request->input('twitter');
    	$speaker->small_desc = $request->input('small_desc');
    	$speaker->website = $request->input('website');
    	//$speaker->activity_id = $request->input('activity_id');
    	
    	
    	$speaker->save();
    	return redirect()->action('SpeakerController@create')->with('sucess', 'Cadastrado com sucesso!');  
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

        $speaker = Speaker::find($id);
        $speaker->name = $request->input('name');
    	$speaker->type = $request->input('type');
    	$speaker->linkedin = $request->input('linkedin');
    	$speaker->facebook = $request->input('facebook');
    	$speaker->twitter = $request->input('twitter');
    	$speaker->small_desc = $request->input('small_desc');
    	$speaker->website = $request->input('website');
    	$speaker->activity_id = $request->input('activity_id');
    	$speaker->picture = $request->input('picture'); //Subir Url da foto .jpg

        $speaker->save();
        return redirect()->action('SpeakerController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$speaker = Speaker::findOrFail($id);
    	$speaker->delete();

    	return redirect()->route('speaker.index')->with('message', 'Atração removida com sucesso!');
    }
}
