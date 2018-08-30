<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Activity;

class CertificateController extends Controller
{
    public function generate(Request $request){
        $id = $request->input('activity_id');
        
        $activity = Activity::with(array(
        'users' => function ($query) use ($request) 
        {
            $query->where('user_id', $request->session()->get('id'));
        }))
        ->with(array(
        'subscribers' => function($query) use ($request)
		{
		     $query->where('user_id', $request->session()->get('id'))
		     ->where('activity_id', $request->input('activity_id'));
		}))
		->first();

        
        $pdf = PDF::loadView('certificate.certificate',['activity' => $activity]);
        return $pdf->download("certificado.pdf");
    }
}
