<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Subscription;

class CertificateController extends Controller
{
    public function generate(Request $request){
        $activity_id = $request->input('activity_id');
        $user_id = $request->session()->get('id');
        
        $subscription = Subscription::with('activity','user')
        ->where('activity_id', $activity_id)
        ->where('user_id', $user_id)
        ->get();
        
        $pdf = PDF::loadView('certificate.certificate',['subscription' => $subscription]);
        return $pdf->download("certificado.pdf");
    }
}
