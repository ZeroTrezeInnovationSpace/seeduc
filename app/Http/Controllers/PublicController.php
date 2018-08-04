<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Public;

class PublicController extends Controller
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
    		return view('public.index');    
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
    	return view('public.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$public = new Public;

    	$public->name = $request->input('name');
    	$public->segment_id = $request->input('segment_id');
    	    	
    	$public->save();
    	return redirect()->action('PublicController@index');  
    }

    public function show($id)
    {        
    	return view('public.show', ['public' => Public::with('users', 'tickets', 'activities')->find($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('public.manage', ['public' => Public::with('users', 'tickets', 'activities')->find($id), 'publicId' => $id]);
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

        $public = Public::find($id);

        $public->name = $request->input('name');
    	$public->segment_id = $request->input('segment_id');

        $public->save();
        return redirect()->action('PublicController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$public = Public::findOrFail($id);
    	$public->delete();

    	return redirect()->route('public.index')->with('message', 'Publico removido com sucesso!');
    }
}
