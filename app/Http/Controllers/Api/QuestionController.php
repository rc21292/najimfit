<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use App\Models\Client;
use App\Models\Package;
use App\Models\Question;
use App\Models\QuestionCategory;
use Carbon\Carbon;
use DB;

class QuestionController extends Controller
{
	public function getquestions(Request $request){
		
		$string = 'both';
		$gender = Auth::Client()->gender;
		if($gender == 'female'){
			$gender = Auth::Client()->gender;
			$QuestionCategory= QuestionCategory::with(['questions' => function($query){
				$query->whereIn('questions.gender',['both', Auth::Client()->gender]);
			}])
			->get();
			$questions = Question::whereIn('gender',['both', Auth::Client()->gender])->orderBy('sort','asc')->select('id','question')->get();
		}else{
			$gender = Auth::Client()->gender;
			$QuestionCategory= QuestionCategory::with(['questions' => function($query){
				$query->where('questions.gender','=','both');
			}])
			->get();
		}
		$response = ['success' => $QuestionCategory];
		return response($response, 200);
	}

	

	public function saveanswers(Request $request){

		$user_id = Auth::Client()->id;


		foreach($request->all() as $key =>$value){
			if (DB::table('client_answers')->where('client_id', '=', $user_id)->exists()) {
				
				if (DB::table('client_answers')->where(['client_id'=>$user_id,'question_id'=>$key])->exists()) {

					DB::table('client_answers')->where(['client_id'=>$user_id,'question_id'=>$key])->update(['answer' => $value]);

				}else{

					DB::table('client_answers')->insert(['client_id' => $user_id, 'question_id' => $key, 'answer' => $value]);

				}

			}else{
				DB::table('client_answers')->insert(['client_id' => $user_id, 'question_id' => $key, 'answer' => $value]);
			}

		}
			$response = ['success' => 'Answers saved successfully'];
			return response($response, 200);
	}


	public function getclientanswers(Request $request){
		$user_id = Auth::Client()->id;

		$questions = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->get();

		$response = ['success' => $questions];
		return response($response, 200);

	}
}
