<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use DateTime;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        #VIEW COM APRESENTAÇÃO DE ATIVIDADE, NOME DA ATIVIDADE, PERIODO, DATA ATIVIDADE, CPF INSCRITO, NOME INSCRITO, DATA/HORA INSCRIÇÃO, TELEFONE, EMAIL
        $subscriptions_relation = DB::table('activities')
            ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
            ->join("users","subscriptions.user_id", "=", "users.id")
            ->select('activities.id as activity_id','activities.name', 'activities.period', 'activities.beginning_date', 'users.CPF', 'users.name as username', 'users.phone_number', 'users.email','subscriptions.created_at')
            ->paginate(10);

        #capacidade das atividades, onde a atividade.name like '%%' e total de inscrições
        $tickets_total = DB::table('activities')
        ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
        ->join("users","subscriptions.user_id", "=", "users.id")
        ->distinct("activities.id")
        ->sum('activities.maximum_capacity');

        $subscriptions_total = DB::table('subscriptions')->COUNT("subscriptions.id"); 


        return view('dashboard.index' , [
            'subscriptions_relation' => $subscriptions_relation,
            'search_activity_key' => $request->input('search_activity_key'),
            'search_user_key' => $request->input('search_activity_key'),
            'tickets_total' => $tickets_total,
            'subscriptions_total' => $subscriptions_total
        ])
         ->with('id', $request->session()->get('id'))
         ->with('bond_id', $request->session()->get('bond_id'))
         ->with('name', $request->session()->get('name'));
    }

    public function searchActivityUsers(Request $request)
    {

     $subscriptions_relation = DB::table('activities')
            ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
            ->join("users","subscriptions.user_id", "=", "users.id")
            ->select('activities.id as activity_id','activities.name', 'activities.period', 'activities.beginning_date', 'users.CPF', 'users.name as username', 'users.phone_number', 'users.email','subscriptions.created_at')
            ->where('activities.name', 'like', '%' . $request->input('search_activity_key') . '%')
            ->where('users.name', 'like', '%' . $request->input('search_user_key') . '%') 
            ->paginate(10)
            ->appends([
                'search_activity_key' => $request->input('search_activity_key'),
                'search_user_key' => $request->input('search_activity_key'),
            ]);

    #capacidade das atividades, onde a atividade.name like '%%' e total de inscrições

        $tickets_total = DB::table('activities')
        ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
        ->join("users","subscriptions.user_id", "=", "users.id")
        ->where('activities.name', 'like', '%' . $request->input('search_activity_key') . '%')
        ->where('users.name', 'like', '%' . $request->input('search_user_key') . '%') 
        ->distinct("activities.id")
        ->sum('activities.maximum_capacity');

        $subscriptions_total = $subscriptions_relation->count();
         

      return view('dashboard.index', [
        'subscriptions_relation' => $subscriptions_relation,
        'search_activity_key' => $request->input('search_activity_key'),
        'search_user_key' => $request->input('search_user_key'),
        'tickets_total' => $tickets_total,
        'subscriptions_total' => $subscriptions_total
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
        #VIEW COM APRESENTAÇÃO DE RELAÇÃO DE ATIVIDADES E TOTAL DE USUÁRIOS INSCRITOS

        /*
    
            SELECT a.id, a.name as 'Nome da atividade', a.minimum_quorum as 'Mínimo Quorum',  a.maximum_capacity as 'Capacidade', count(s.id) as 'Total de Inscrições', a.maximum_capacity - count(s.id) 'Vagas Sobrando' FROM activities a INNER JOIN subscriptions s ON a.id = s.activity_id group by a.id having (a.maximum_capacity - count(s.id)) > 0;

        */

        $subscriptions_relation = DB::table('activities')
        ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
        ->select('activities.id','activities.name', 'activities.minimum_quorum', 'activities.maximum_capacity', 'count(subscriptions.id)', 'activities.maximum_capacity - count(subscriptions.id)')
        ->having("activities.maximum_capacity - count(subscriptions.id)",">","0")
        ->groupBy("activities.id")
        ->paginate(10);

        return view('dashboard.subscriptions' , [
            'subscriptions_relation' => $subscriptions_relation
        ])
        ->with('id', $request->session()->get('id'))
        ->with('bond_id', $request->session()->get('bond_id'))
        ->with('name', $request->session()->get('name'));
    }

}
