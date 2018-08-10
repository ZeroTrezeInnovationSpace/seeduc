<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Activity;
use DB;

class SubscribeController extends Controller
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
    		return view('subscription.index');    
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
    	return view('subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #Chamando função para verificar se usuário já está inscrito
        $inscrito = $this->verifySubscriber($request->input('user_id'), $request->input('activity_id'));
        $max = $this->verifyCapacity($request->input('activity_id'));

        if($inscrito == 0){   
            if($max == 0){
                $date_time = $this->verifyDateTimeActivity($request->input('user_id'), $request->input('activity_id')); 
                if($date_time == 0){    
                    $subscription = new Subscription;

                    $subscription->user_id = $request->input('user_id');
                    $subscription->activity_id = $request->input('activity_id');

                    $subscription->save();
                    return redirect()->action('ActivityController@index')->with('sucess', 'Inscrito com sucesso!');
                }else{
                    return redirect()->action('ActivityController@index')->with('error', 'Possui evento no mesmo horário.');
                }
            }else{
               return redirect()->action('ActivityController@index')->with('error', 'Evento com capacidade máxima atingida.'); 
           }
       }else{
        return redirect()->action('ActivityController@index')->with('error', 'Já inscrito no evento!');
    }
}

public function show($id)
{        
 return view('subscription.show', ['subscriptions' => Subscription::find($id)]);    
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
    	return view('subscription.manage', ['subscriptions' => Subscription::find($id), 'subscriptionId' => $id]);
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

        $subscription = Subscription::find($id);
        $subscription->user_id = $request->input('user_id');
        $subscription->activity_id = $request->input('activity_id');
        $subscription->certificate = $request->input('certificate');

        $subscription->save();
        return redirect()->action('SubscriptionController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    	//$subscription = Subscription::find($request->input('subscription_id'))->delete();
    	//$subscription->delete();
        //print($subscription);
        $subscriptions = Subscription::where('user_id', $request->input('user_id'))
        ->where('activity_id', $request->input('activity_id'))
        ->get();
        foreach ($subscriptions as $subscription) {
            $inscrição = $subscription->id;
        }

        Subscription::destroy($inscrição);


        return redirect()->action('FeedController@index')
        ->with('info', 'Cancelado com sucesso -  Subs: '.$inscrição); 
    }

    public function verifySubscriber($user_id, $activity_id){

        $verificar = Subscription::all()->where('user_id', $user_id)
        ->where('activity_id', $activity_id);
        
        $inscrito = 0;

        foreach ($verificar as $verifica) {
            if($verifica)
                $inscrito++;
        }

        return $inscrito;
    }

    public function verifyDateTimeActivity($user_id, $activity_id){
        $activity = Activity::where('id', $activity_id)->get();

        $verificar = DB::table('activities')
        ->join('subscriptions', 'activities.id', '=', 'subscriptions.activity_id')
        ->where('subscriptions.user_id', $user_id)
        ->select('activities.beginning_date', 'activities.period')
        ->get();
        
        $count = 0;
        foreach ($verificar as $verifica) {
            if($verifica->period == $activity[0]->period && 
                $verifica->beginning_date == $activity[0]->beginning_date)
                ++$count; 
            }
            
            return $count;
        }

        public function verifyCapacity($activity_id){
            if($activity_id == 14){
                return 1;
            }
            else{
                $activity = Activity::where('id', $activity_id)->get();
                $subscriptions = Subscription::where('activity_id', $activity_id)->count();
                $full = 0;
                if($activity[0]->maximum_capacity == $subscriptions){
                    $full++;
                }
                return $full;
            }
        }

    }
