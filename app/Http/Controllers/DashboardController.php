<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Subscription;
use DateTime;
use PDF;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        #VIEW COM APRESENTAÇÃO DE RELAÇÃO DE ATIVIDADES E TOTAL DE USUÁRIOS INSCRITOS

        /*
    
            SELECT a.id, a.name as 'Nome da atividade', a.minimum_quorum as 'Mínimo Quorum',  a.maximum_capacity as 'Capacidade', count(s.id) as 'Total de Inscrições', a.maximum_capacity - count(s.id) 'Vagas Sobrando' FROM activities a INNER JOIN subscriptions s ON a.id = s.activity_id group by a.id having (a.maximum_capacity - count(s.id)) > 0;
            ->having("activities.maximum_capacity - count(subscriptions.id)",">","0")
        */

            $subscriptions_relation = DB::table("activities")
            ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id") 
            ->select(DB::raw('count(subscriptions.id) as subscriptions_total , activities.id , activities.name , activities.period, activities.maximum_capacity'))
            ->groupBy('activities.id')
            ->paginate(1);



            return view('dashboard.index' , [
              'subscriptions_relation' => $subscriptions_relation,
              'search_activity_key' => $request->input('search_activity_key')
            ])
            ->with('id', $request->session()->get('id'))
            ->with('bond_id', $request->session()->get('bond_id'))
            ->with('name', $request->session()->get('name'));
          }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function subscriptions(Request $request)
     {

        #VIEW COM APRESENTAÇÃO DE ATIVIDADE, NOME DA ATIVIDADE, PERIODO, DATA ATIVIDADE, CPF INSCRITO, NOME INSCRITO, DATA/HORA INSCRIÇÃO, TELEFONE, EMAIL
      $subscriptions_relation = DB::table('activities')
      ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
      ->join("users","subscriptions.user_id", "=", "users.id")
      ->select('activities.id as activity_id','activities.name', 'activities.period', 'activities.beginning_date', 'users.id as user_id', 'users.CPF', 'users.name as username', 'users.phone_number', 'users.email','subscriptions.check_in','subscriptions.created_at')
      ->where('activities.id',$request->input('activity_id'))
      ->paginate(10)
      ->appends([
      'activity_id' => $request->input('activity_id')
      ]);

        #capacidade da atividade
      $tickets_total = DB::table('activities')
      ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
      ->join("users","subscriptions.user_id", "=", "users.id")
      ->where('activities.id',$request->input('activity_id'))
      ->distinct('activities.id')
      ->sum('activities.maximum_capacity');

        //Total de inscrições da atividade
      $subscriptions_total = DB::table('activities')
      ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
      ->where('activities.id',$request->input('activity_id'))->COUNT("subscriptions.id"); 


      return view('dashboard.subscriptions' , [
        'subscriptions_relation' => $subscriptions_relation,
        'search_activity_key' => $request->input('search_activity_key'),
        'search_user_key' => $request->input('search_activity_key'),
        'activity_id' => $request->input('activity_id'),
        'tickets_total' => $tickets_total,
        'subscriptions_total' => $subscriptions_total,
        'activity_name' => $subscriptions_relation[0]->name
      ])
      ->with('id', $request->session()->get('id'))
      ->with('bond_id', $request->session()->get('bond_id'))
      ->with('name', $request->session()->get('name'));
    }


    public function searchActivity(Request $request)
    {


      $subscriptions_relation = DB::table("activities")
            ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id") 
            ->select(DB::raw('count(subscriptions.id) as subscriptions_total , activities.id , activities.name , activities.period, activities.maximum_capacity'))
            ->where('activities.name', 'like', '%' . $request->input('search_activity_key') . '%')
            ->groupBy('activities.id')
            ->paginate(1)
             ->appends([
              'search_activity_key' => $request->input('search_activity_key')
             ]);
            
     

      #capacidade das atividades, onde a atividade.name like '%%' e total de inscrições

     $tickets_total = DB::table('activities')
     ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
     ->where('activities.name', 'like', '%' . $request->input('search_activity_key') . '%')
     ->distinct('activities.id')
     ->sum('activities.maximum_capacity');

     $subscriptions_total = $subscriptions_relation->count(); 


     return view('dashboard.index', [
      'subscriptions_relation' => $subscriptions_relation,
      'search_activity_key' => $request->input('search_activity_key'),
      'tickets_total' => $tickets_total,
      'subscriptions_total' => $subscriptions_total,
    ])
     ->with('id', $request->session()->get('id'))
     ->with('bond_id', $request->session()->get('bond_id'))
     ->with('name', $request->session()->get('name'));
   }

   public function searchUsers(Request $request)
   {

     $subscriptions_relation = DB::table('activities')
     ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
     ->join("users","subscriptions.user_id", "=", "users.id")
     ->select('activities.id as activity_id','activities.name', 'activities.period', 'activities.beginning_date', 'users.CPF', 'users.id as user_id','users.name as username', 'users.phone_number', 'users.email','subscriptions.check_in','subscriptions.created_at')
     ->where('activities.id', $request->input('activity_id'))
     ->where('users.name', 'like', '%' . $request->input('search_user_key') . '%') 
     ->paginate(10)
     ->appends([
      'activity_id' => $request->input('activity_id'),
      'search_user_key' => $request->input('search_user_key'),
      ]);

      #capacidade das atividades, onde a atividade.name like '%%' e total de inscrições

     $tickets_total = DB::table('activities')
     ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
     ->join("users","subscriptions.user_id", "=", "users.id")
     ->where('activities.id',$request->input('activity_id'))
     ->distinct('activities.id')
     ->sum('activities.maximum_capacity');

     $subscriptions_total = $subscriptions_relation->count();


     return view('dashboard.subscriptions', [
      'subscriptions_relation' => $subscriptions_relation,
      'search_user_key' => $request->input('search_user_key'),
      'tickets_total' => $tickets_total,
      'activity_id' => $request->input('activity_id'),
      'subscriptions_total' => $subscriptions_total
    ])
     ->with('id', $request->session()->get('id'))
     ->with('bond_id', $request->session()->get('bond_id'))
     ->with('name', $request->session()->get('name'));
   }

   public function checkIn(Request $request){


    $user_subscription = Subscription::where('activity_id',$request->input('activity_id'))
    ->where('user_id',$request->input('user_id'))
    ->first();

    $user_subscription->check_in = 1;
    $user_subscription->save();

    return redirect()->back()->with('success', 'Check In efetuado com sucesso');
  }

    public function attendanceList(Request $request){

      $subscriptions_relation = DB::table('activities')
      ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
      ->join("users","subscriptions.user_id", "=", "users.id")
      ->select('activities.id as activity_id','activities.name', 'activities.period', 'activities.beginning_date', 'users.id as user_id', 'users.CPF', 'users.name as username', 'users.phone_number', 'users.email','subscriptions.check_in','subscriptions.created_at')
      ->where('activities.id',$request->input('activity_id'))
      ->orderBy('users.name','asc')
      ->get();

      $pdf = PDF::loadView('dashboard.attendanceList', ['subscriptions' => $subscriptions_relation ]);

      return $pdf->download("ListaDePresença".$subscriptions_relation[0]->name.".pdf");

    }
  }

