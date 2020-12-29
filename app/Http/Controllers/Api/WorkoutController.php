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
use DateTime;
use App\Models\Package;
use App\Models\Exercise;
use Carbon\Carbon;
use DB;
use Session;

class WorkoutController extends Controller
{
	public function getworkouts(Request $request){

		$active_day = 0;
		$client_workouts = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->exists();
		if ($client_workouts) {
			$workout_data = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->orderBy('day', 'asc')->first();
			$fdate = $workout_data->created_at;
			$tdate21 = date('Y-m-d H:i:s',strtotime($request->date));
			$tdate = new DateTime($tdate21);
			$datetime1 = new DateTime($fdate);
			$datetime2 = new DateTime($tdate21);
			$interval = $datetime1->diff($datetime2);
			$active_day = $interval->format('%a');
		}

		$workoutss = DB::table('client_workouts')
		->join('exercises','exercises.id','=','client_workouts.exercise')
		->select('exercises.id as exercise_id','exercises.*','exercises.name','client_workouts.day','client_workouts.id as workout_id','client_workouts.*')
		->where('client_workouts.client_id',Auth::Client()->id);
		if (isset($request->date)) {
		$workoutss->where('client_workouts.day',$active_day);
		}
		$workouts = $workoutss->get();

		if(!$workouts->isEmpty()){
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
					"status" => $workout->status,
					"description" => $request->language == "arabic" ? $workout->description_arabic : $workout->description,
				);
			}

			$data = $exercises;

			return response()->json(['success' => true,'message'=> 'data fetched successfully','data'=> $data], 200);
			
		}else{
			return response(['success' => false,'message'=>'Workout not assigned by Nutrionist'], 422);
		}		
	}

	public function getexercisedetails(Request $request){
		$workout = DB::table('client_workouts')
		->join('exercises','exercises.id','=','client_workouts.exercise')
		->select('exercises.id as exercise_id','exercises.*','exercises.name','client_workouts.day','client_workouts.id as workout_id','client_workouts.*')
		->where('client_workouts.id',$request->workout_id)
		->first();
		$workout->day =  $workout->day;
		$workout->workout_id = $workout->workout_id;
		$workout->image = 'https://tegdarco.com/uploads/exercises/'.$workout->image;
		$workout->name =$request->language == "arabic" ? $workout->description_arabic : $workout->name;
		unset($workout->name_arabic);
		$workout->sets =$workout->sets;
		$workout->reps = $workout->reps;
		$workout->description =$request->language == "arabic" ? $workout->description_arabic : $workout->description;
		unset($workout->description_arabic);
		if(isset($workout)){
			$data = $workout;
			return response()->json(['success'=> $data], 200);
		}else{
			return response(['errors'=>'Workout not assigned by Nutrionist'], 422);
		}
	}


	public function getworkoutinstructions(Request $request){
		$instructions = DB::table('workout_information')->get();
		if(!$instructions->isEmpty()){
			foreach($instructions as $instruction){
				$instruct[] = array(
					"insturction_id" => $instruction->id,
					"name" => $request->language == "arabic" ? $instruction->name_arabic : $instruction->name,
					"description" => $request->language == "arabic" ? $instruction->information_arabic : $instruction->information,
				);
			}

			$data = $instruct;
			return response()->json(['success'=> $data], 200);

		}else{
			return response(['errors'=>'No Instructions found!'], 422);
		}
	}

	public function completeworkout(Request $request){
		$workouts = DB::table('client_workouts')->where('id',$request->workout_id)->update(['timer'=>$request->timer, 'status'=>"completed"]);
		$workout = DB::table('client_workouts')->where('id',$request->workout_id)->where('client_workouts.client_id',Auth::Client()->id)->exists();
		if($workout){
			$data = "Exercises marked as Completed!";
			return response()->json(['success'=> $data], 200);

		}else{
			return response(['errors'=>'No Workout found for this Workout id!'], 422);

		}
	}

	public function summaryworkout(Request $request){

		$workoutss = DB::table('client_workouts')
		->join('exercises','exercises.id','=','client_workouts.exercise')
		->select('exercises.id as exercise_id','exercises.*','exercises.name','client_workouts.day','client_workouts.id as workout_id','client_workouts.*')
		->where('client_workouts.client_id',Auth::Client()->id)->where('client_workouts.status','completed')
		->get();
		/*->sum('exercises.calories');*/

		$total_calories = 0;
		foreach ($workoutss as $key => $workouts) {
			$total_calories += (explode("-", $workouts->calories)[1]);
		}

		$workouts = DB::table('client_workouts')
		->join('exercises','exercises.id','=','client_workouts.exercise')
		->select('exercises.id as exercise_id','exercises.*','exercises.name','client_workouts.day','client_workouts.id as workout_id','client_workouts.*')
		->where('client_workouts.client_id',Auth::Client()->id)
		->where('client_workouts.day',$request->day)
		->where('client_workouts.status','completed')
		->get();

		if(!$workouts->isEmpty()){
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
					"status" => $workout->status,
					"description" => $request->language == "arabic" ? $workout->description_arabic : $workout->description,
				);
			}

			$data = $exercises;
			$data['total_calories'] = $total_calories;
			return response()->json(['success'=> $data], 200);
			
		}else{
			return response(['errors'=>'Workout not assigned by Nutrionist or Please check Day parameter'], 422);
		}
	}
	
}
