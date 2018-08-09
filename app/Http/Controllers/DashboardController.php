<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #VIEW COM APRESENTAÇÃO DE ATIVIDADE, NOME DA ATIVIDADE, PERIODO, DATA ATIVIDADE, CPF INSCRITO, NOME INSCRITO, DATA/HORA INSCRIÇÃO
        $subscription_relation = DB::raw("SELECT a.name, a.period, a.beginning_date, u.CPF, u.name, s.created_at FROM activities a"))
            ->join("subscriptions s", "a.id", "=", "s.activity_id")
            ->join("users u","s.user_id", "=", "u.id")
            ->get();
        return view('dashboard.index' , [
            'subscriptions_relation' => $subscriptions_relation
        ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscriptions()
    {
        #VIEW COM APRESENTAÇÃO DE RELAÇÃO DE ATIVIDADES E TOTAL DE USUÁRIOS INSCRITOS
        return view('dashboard.subscriptions');
    }

}
