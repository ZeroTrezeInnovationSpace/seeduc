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
        #VIEW COM APRESENTAÇÃO DE ATIVIDADE, NOME DA ATIVIDADE, PERIODO, DATA ATIVIDADE, CPF INSCRITO, NOME INSCRITO, DATA/HORA INSCRIÇÃO
        $subscriptions_relation = DB::table('activities')
            ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
            ->join("users","subscriptions.user_id", "=", "users.id")
            ->select('activities.name', 'activities.period', 'activities.beginning_date', 'users.CPF', 'users.name', 'subscriptions.created_at')
            ->get();

        return view('dashboard.index' , [
            'subscriptions_relation' => $subscriptions_relation
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
         $subscriptions_relation = DB::table('activities')
            ->join("subscriptions", "activities.id", "=", "subscriptions.activity_id")
            ->join("users","subscriptions.user_id", "=", "users.id")
            ->select('activities.name', 'activities.period', 'activities.beginning_date', 'users.CPF', 'users.name', 'subscriptions.created_at')
            ->get();

         $subscription_relation = DB::raw("SELECT a.name, a.period, a.beginning_date, count() FROM subscriptions s")
            ->join("activities a", "s.activity_id", "=", "a.id")
            ->join("users u","s.user_id", "=", "u.id")
            ->groupBy("")
            ->get();
        return view('dashboard.subscriptions' , [
            'subscriptions_relation' => $subscriptions_relation
        ])
        ->with('id', $request->session()->get('id'))
         ->with('bond_id', $request->session()->get('bond_id'))
         ->with('name', $request->session()->get('name'));
    }

}
