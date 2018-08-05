<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
	public function store(Request $request)
	{/*
		$id =  $request->session()->get('id');
		
		$quiz = new Quiz;

		$quiz->bond_id = $request->input('bond_id');
		$quiz->need_libras_interpreter = $request->input('need_libras_interpreter');
		$quiz->beginning_date = $request->input('beginning_date');
		$quiz->know_technology = $request->input('know_technology');
		$quiz->used_to_sites = $request->input('used_to_sites');
		$quiz->maximum_capacity = $request->input('maximum_capacity');
		$quiz->adept_qr_code = $request->input('adept_qr_code');
		$quiz->smartphone = $request->input('smartphone');
		$quiz->kind_professor = $request->input('teacher');
		if($request->input('city') == 'Outro'){
			$quiz->city_professor_work_at = print_r($request->input('outro'));
		}else{
			$quiz->city_professor_work_at = $request->input('city_professor_work_at');
		}
		if(!is_null($request->input('teacher'))){
			$quiz->professor = 1; 
		}else{
			$quiz->professor = 0; 
		}

		$quiz->save();

		$user = User::find($id);
		$user->quiz_id = $quiz_id;
		$activity->save();
*/
		return redirect()->action('FeedController@index'); 

	}
}
