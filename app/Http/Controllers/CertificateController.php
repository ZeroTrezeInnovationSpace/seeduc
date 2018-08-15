<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Activity;

class CertificateController extends Controller
{
    public function generate(Request $request){
        $id = $request->input('activity_id');
        
        $activity = Activity::with('users')
        ->with(array(
        'subscribers' => function($query) use ($request)
		{
		     $query->where('user_id', $request->session()->get('id'))
		     ->where('activity_id', $request->input('activity_id'));
		}))
        ->where('id', $id)
		->first();

        
        $pdf = PDF::loadView('certificate.certificate',['activity' => $activity]);
        return $pdf->download("certificado.pdf");
    }
}
