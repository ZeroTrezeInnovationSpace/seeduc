<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedbackQuiz;
use App\UsersFeedback;

class FeedbackQuizController extends Controller
{

	public function index(Request $request){

		return view('quiz.indexFeedbackUser', ['quizzes' => FeedbackQuiz::
			join('users_feedbacks', 'feedback_quizzes.id', '=', 'users_feedbacks.feedback_id')
			->join('users', 'users.id', '=', 'users_feedbacks.user_id')
			->where('users_feedbacks.activity_id', $request->input('activity_id'))
			->get()
		])
		->with('id', $request->session()->get('id'))
		->with('bond_id', $request->session()->get('bond_id'))
		->with('name', $request->session()->get('name'));
	}

	public function feedbackQuiz(Request $request){
		$activity_id = $request->input('activity_id');
		return view('quiz.feedbackQuiz', ['activity_id' => $activity_id])
		->with('id', $request->session()->get('id'))
		->with('bond_id', $request->session()->get('bond_id'))
		->with('name', $request->session()->get('name'));
	}

	public function store(Request $request){
		#Recebendo o ID do usuário na SESSION

		$id =  $request->session()->get('id');

		#Inserção Tabela de FeedBackQuiz
		
		$feedbackQuiz = new FeedbackQuiz;
		$feedbackQuiz->A1 = $request->input('A1');
		$feedbackQuiz->B1 = $request->input('B1');
		$feedbackQuiz->C1 = $request->input('C1');
		$feedbackQuiz->D1 = $request->input('D1');
		$feedbackQuiz->A2 = $request->input('A2');
		$feedbackQuiz->users_comment = $request->input('users_comment');
		$feedbackQuiz->A3 = $request->input('A3');
		$feedbackQuiz->B3 = $request->input('B3');
		$feedbackQuiz->justify_B3_answer = $request->input('justify_B3_answer');
		$feedbackQuiz->C3 = $request->input('C3');
		$feedbackQuiz->justify_C3_answer = $request->input('justify_C3_answer');
		$feedbackQuiz->users_praise = $request->input('users_praise');
		$feedbackQuiz->users_criticism = $request->input('users_criticism');
		$feedbackQuiz->users_suggestions = $request->input('users_suggestions');
		$feedbackQuiz->save();

		#Inserção Tabela de Resolução

		$userFeedback = new UsersFeedback;
		$userFeedback->user_id = $id;
		$userFeedback->feedback_id = $feedbackQuiz->id;
		$userFeedback->activity_id = $request->input('activity_id');
		$userFeedback->save();

		return redirect()->action('FeedController@index'); 

	}
}
