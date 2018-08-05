<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\Bond;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
    	/*Se a pessoa for admin ou alguma perfil de organizador ela pode ver o evento gerenciável
    	if(Auth::user()->hasRole('admin')){
    		return view('event.index');    
    	}//fazer else if para caso a pessoa tenha algum perfil de público que possa ver o evento não gerenciavel em seu feed
    	else{
    		return view('feed.index');    
    	}*/
        if($request->session()->get('id') != null && $request->session()->get('name') != null){
            /*$quiz = User::where('id', $request->session()->get('id'))->get();
            if(is_null($quiz[0]->quiz_id) ){
                return view('quiz.quiz', ['bonds' => Bond::all()] )
                ->with('id', $request->session()->get('id'))
                ->with('bond_id', $request->session()->get('bond_id'))
                ->with('name', $request->session()->get('name'));
            }*/
            
            return view('feed.index', ['userActivities' => User::with('activities', 'activities.event', 
                'activities.subscribers')
            ->where('id', $request->session()->get('id'))->get(), 'events' => Event::all()])
            ->with('id', $request->session()->get('id'))
            ->with('bond_id', $request->session()->get('bond_id'))
            ->with('name', $request->session()->get('name'));

        }else{
            return view('auth.login');
        }
    }

}
