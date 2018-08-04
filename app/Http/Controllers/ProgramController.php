<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;

class ProgramController extends Controller
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
    		return view('program.index');    
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
    	return view('program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$program = new Program;

    	$program->name = $request->input('name');
    	$program->schedule_id = $request->input('schedule_id');
    	$program->beginning_hour = $request->input('beginning_hour');
    	$program->close_hour = $request->input('close_hour');
    	
    	$program->save();
    	return redirect()->action('ProgramController@index');  
    }

    public function show($id)
    {        
    	return view('program.show', ['program' => Program::with('activity', 'schedule')->find($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('program.manage', ['program' => Program::with('activity', 'schedule')->find($id)]);
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

        $program = Program::find($id);
        $program->name = $request->input('name');
        $program->schedule_id = $request->input('schedule_id');
        $program->beginning_hour = $request->input('beginning_hour');
        $program->close_hour = $request->input('close_hour');

        $program->save();
        return redirect()->action('ProgramController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$program = Program::findOrFail($id);
    	$program->delete();

    	return redirect()->route('program.index')->with('message', 'Programação removida com sucesso!');
    }

}
