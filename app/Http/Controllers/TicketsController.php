<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tickets;
use PDF;

class TicketsController extends Controller
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
    		return view('ticket.index');    
    	}//fazer else if para caso a pessoa tenha algum perfil de público que possa ver o evento não gerenciavel em seu feed
    	else{
    		return view('feed.index');    
    	}

    }

    public function generate(Request $request){
        if($request->input('bond_id') == 1){
            $pdf = PDF::loadView('ticket.generate_intern');
        }elseif($request->input('bond_id') == 3){
            $pdf = PDF::loadView('ticket.generate_extern');
        }
        
        return $pdf->download("inscrição.pdf");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$tickets = new Tickets;

    	$tickets->name = $request->input('name');
    	$tickets->creation_date = $request->input('creation_date');
    	$tickets->creation_hour = $request->input('creation_hour');
    	$tickets->price = $request->input('price');
    	$tickets->descripition = $request->input('descripition');
    	$tickets->publics_id = $request->input('publics_id');
    	$tickets->batches_id = $request->input('batches_id');
    	$tickets->events_id = $request->input('events_id');
    	
    	$tickets->save();
    	return redirect()->action('TicketsController@index');  
    }

    public function show($id)
    {        
    	return view('ticket.show', ['tickets' => Tickets::with('user', 'batch', 'crowd', 'event')->find($id)]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('ticket.manage', ['tickets' => Tickets::with('user', 'batch', 'crowd', 'event')->find($id), 'ticketId' => $id]);
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

        $tickets = Tickets::find($id);
        $tickets->name = $request->input('name');
        $tickets->creation_date = $request->input('creation_date');
        $tickets->creation_hour = $request->input('creation_hour');
        $tickets->price = $request->input('price');
        $tickets->descripition = $request->input('descripition');
        $tickets->publics_id = $request->input('publics_id');
        $tickets->batches_id = $request->input('batches_id');
        $tickets->events_id = $request->input('events_id');

        $tickets->save();
        return redirect()->action('TicketsController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$tickets = Tickets::findOrFail($id);
    	$tickets->delete();

    	return redirect()->route('tickets.index')->with('message', 'Ingresso removido com sucesso!');
    }
}
