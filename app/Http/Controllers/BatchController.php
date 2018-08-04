<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;

class BatchController extends Controller
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
     		return view('batch.index');    
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
    	return view('batch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$batch = new Batch;

    	$batch->name = $request->input('name');
    	$batch->beginning_date = $request->input('beginning_date');
    	$batch->beginning_hour = $request->input('beginning_hour');
    	$batch->end_date = $request->input('end_date');
    	$batch->end_hour = $request->input('end_hour');
    	$batch->min_tickets = $request->input('min_tickets');
    	$batch->max_tickets = $request->input('max_tickets');
    	$batch->activity_id = $request->input('activity_id');
    	$batch->user_id = $request->input('user_id');
    	
    	$batch->save();
    	return redirect()->action('BatchController@index');  
    }

    public function show($id)
    {        
    	return view('batch.show', ['batches' => Batch::with('activity', 'tickets')->find($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('batch.manage', ['batches' => Batch::with('activity', 'tickets'), 'batchId' => $id]);
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

        $batch = Batch::find($id);
        $batch->name = $request->input('name');
    	$batch->beginning_date = $request->input('beginning_date');
    	$batch->beginning_hour = $request->input('beginning_hour');
    	$batch->end_date = $request->input('end_date');
    	$batch->end_hour = $request->input('end_hour');
    	$batch->min_tickets = $request->input('min_tickets');
    	$batch->max_tickets = $request->input('max_tickets');
    	$batch->activity_id = $request->input('activity_id');
    	$batch->user_id = $request->input('user_id');

        $batch->save();
        return redirect()->action('BatchController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$batch = Batch::findOrFail($id);
    	$batch->delete();

    	return redirect()->route('batch.index')->with('message', 'Lote removido com sucesso!');
    }

}
