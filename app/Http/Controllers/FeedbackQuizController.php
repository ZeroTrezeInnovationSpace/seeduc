<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedbackQuiz;
use App\UsersFeedback;
use Redirect;

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

		#Recebendo o ID do usuário na SESSION

		$id =  $request->session()->get('id');
	
		$feedbackQuiz = new FeedbackQuiz;
		$feedbackQuiz->A1 = '1';
		$feedbackQuiz->B1 = '1';
		$feedbackQuiz->C1 = '1';
		$feedbackQuiz->D1 = '1';
		$feedbackQuiz->A2 = '1';
		$feedbackQuiz->users_comment = '1';
		$feedbackQuiz->A3 = '1';
		$feedbackQuiz->B3 = '1';
		$feedbackQuiz->justify_B3_answer = '1';
		$feedbackQuiz->C3 = '1';
		$feedbackQuiz->justify_C3_answer = '1';
		$feedbackQuiz->users_praise = '1';
		$feedbackQuiz->users_criticism = '1';
		$feedbackQuiz->users_suggestions = '1';
		$feedbackQuiz->save();

		#Inserção Tabela de Resolução

		$userFeedback = new UsersFeedback;
		$userFeedback->user_id = $id;
		$userFeedback->feedback_id = $feedbackQuiz->id;
		$userFeedback->activity_id = $request->input('activity_id');
		$userFeedback->save();

		return Redirect::to('https://docs.google.com/forms/d/1rJoAIqqOxuzAtEZFpOADV7KI2PCa15bA_fsYaDV8MWc/edit');
	}

	public function store(Request $request){

	}
}
