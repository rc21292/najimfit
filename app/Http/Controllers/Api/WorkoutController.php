<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientWorkout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use App\Models\Package;
use App\Models\Exercise;
use Carbon\Carbon;
use DB;
use Session;

class WorkoutController extends Controller
{
	public function getworkouts(Request $request){
		$workouts = DB::table('client_workouts')
		->join('exercises','exercises.id','=','client_workouts.exercise')
		->select('exercises.id as exercise_id','exercises.*','exercises.name','client_workouts.day','client_workouts.id as workout_id','client_workouts.*')
		->where('client_workouts.client_id',Auth::Client()->id)
		->get();

		foreach($workouts as $workout){
			$exercises[] = array(
				"day" => $workout->day,
				"client_id" => Auth::Client()->id,
				"workout_id" => $workout->workout_id,
				"name" => $request->language == "arabic" ? $workout->name_arabic : $workout->name,
				"image" => 'https://tegdarco.com/uploads/exercises/'.$workout->image,
				"video" => "https://www.youtube.com/watch?v=ti3tbscESUY",
				"time" => $workout->time,
				"calories" => $workout->calories,
				"sets" => $workout->sets,
				"reps" => $workout->reps,
				"description" => $request->language == "arabic" ? $workout->description_arabic : $workout->description,
			);
		}

		$data = $exercises;
		return response()->json(['success'=> $data], 200);
	}

	public function getexercisedetails(Request $request){
		$workout = DB::table('client_workouts')
		->join('exercises','exercises.id','=','client_workouts.exercise')
		->select('exercises.id as exercise_id','exercises.*','exercises.name','client_workouts.day','client_workouts.id as workout_id','client_workouts.*')
		->where('client_workouts.id',$request->workout_id)
		->first();
		

			$exercises[] = array(
				"day" => $workout->day,
				"client_id" => Auth::Client()->id,
				"workout_id" => $workout->workout_id,
				"name" => $request->language == "arabic" ? $workout->name_arabic : $workout->name,
				"image" => 'https://tegdarco.com/uploads/exercises/'.$workout->image,
				"video" => "https://www.youtube.com/watch?v=ti3tbscESUY",
				"time" => $workout->time,
				"calories" => $workout->calories,
				"sets" => $workout->sets,
				"reps" => $workout->reps,
				"description" => $request->language == "arabic" ? $workout->description_arabic : $workout->description,
			);
		

		$data = $exercises;
		return response()->json(['success'=> $data], 200);

	}
}
