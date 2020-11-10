<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use App\Models\Package;
use Carbon\Carbon;
use DB;
use Session;
use App\Models\Term;
use App\Models\PrivacyPolicy;
use File;
use Image;
use App\Models\QuestionCategory;
class AuthController extends Controller
{
	public function register (Request $request) {
		$validator = Validator::make($request->all(), [
			'firstname' => 'required|string|max:255',
			'lastname' => 'required|string|max:255',
			'phone' => 'required|numeric|min:11',
			'email' => 'required|string|email|max:255|unique:clients',
			'password' => 'required|string|min:6',
		]);
		if ($validator->fails())
		{
			$array = implode(',', $validator->errors()->all());
			return response(['errors'=>$array], 422);
		}
		$request['password']=Hash::make($request['password']);
		$request['remember_token'] = Str::random(10);
		$user = Client::create($request->toArray());
		$nutritionists = DB::table('nutritionist_clients')
		->select('nutritionist_id', DB::raw('count(*) as client_total'))
		->groupBy('nutritionist_id')
		->get();

		foreach($nutritionists as $nutritionist){
			if($nutritionist->client_total < 30){
				DB::table('nutritionist_clients')->insert(['client_id'=>$user->id,'table_status'=>'due','workout_status'=>'due','nutritionist_id'=>$nutritionist->nutritionist_id]);
				break;
			}
		}
		$token = $user->createToken('Laravel Password Grant Client')->accessToken;
		$response = ['token' => $token];
		return response($response, 200);
	}
	public function selectgender(Request $request){
		$validator = Validator::make($request->all(), [
			'gender' => 'required|string|max:7',
		]);
		if ($validator->fails())
		{
			$array = implode(',', $validator->errors()->all());
			return response(['errors'=>$array], 422);
		}
		$user_id = Auth::Client()->id;
		$user = Client::find($user_id);
		$user->gender = $request['gender'];
		$user->save();
		$response = ['success' => "Gender Selected Successfully"];
		return response($response, 200);


	}

	public function getpackages(Request $request){
		$packages = Package::all();
		foreach ($packages as $row) {
			$allpackages[] = array(

				'id'  => $row->id,
				'name'  => $request->language == "arabic" ? $row->name_arabic : $row->name,
				'price'  => $row->price,
				'validity'  => $row->validity.' days',
				'target'  => $request->language == "arabic" ? $row->target_arabic : $row->target,
				'description' => $request->language == "arabic" ? $row->description_arabic : $row->description,
				'image' =>'https://tegdarco.com/uploads/packages/'.$row->image,

			);            
		}
		
		$response = ['success' => $allpackages];
		return response($response, 200);


	}

	public function selectpackage(Request $request){
		$user_id = Auth::Client()->id;
		$current_package = Client::find($user_id);

		$validity = Package::where('id', $request->package_id)->value('validity');
		if($current_package->validity >= Carbon::now()){
			$response = ['success' => 'You already have an active package. Current Package is Valid Upto '.$current_package->validity];
		}else{

			$valid_upto = Carbon::now()->addDays($validity);

			Client::where('id',$user_id)->update(['package_id' => $request->package_id, 'validity' => $valid_upto]);

			DB::table('transactions')->insert(['client_id' => $user_id, 'package_id' => $request->package_id, 'transaction_id' =>$request->transaction_id, 'amount' => $request->amount ]);
			$response = ['success' => 'This package has been assigned to you..!'];
		}

		return response($response, 200);


	}

	public function login (Request $request) {
		$validator = Validator::make($request->all(), [
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|min:6',
		]);
		if ($validator->fails())
		{
			$array = implode(',', $validator->errors()->all());
			return response(['errors'=>$array], 422);
		}
		$user = Client::where('email', $request->email)->first();
		if ($user) {
			if (Hash::check($request->password, $user->password)) {
				$token = $user->createToken('Laravel Password Grant Client')->accessToken;
				$response = ['token' => $token];
				return response($response, 200);
			} else {
				$response = ["message" => "Password mismatch"];
				return response($response, 422);
			}
		} else {
			$response = ["message" =>'Client does not exist'];
			return response($response, 422);
		}
	}

	public function logout (Request $request) {
		$token = $request->user()->token();
		$token->revoke();
		$response = ['message' => 'You have been successfully logged out!'];
		return response($response, 200);
	}

	public function getcountryflags(){
		$countries= Countries::all()->pluck('currencies','flag.emoji')->toArray();
		$response = ['success' => $countries];
		return response($response, 200);
	}

	public function terms(){
		$term = Term::first();
		$response = ['success' => $term];
		return response($response, 200);
	}

	public function privacyPolicy(){
		$term = PrivacyPolicy::first();
		$response = ['success' => $term];
		return response($response, 200);
	}

	public function about(){
		$about_us = AboutUs::first();
		$response = ['success' => $about_us];
		return response($response, 200);
	}
	
	public function getuserdetails(){
		$client = Client::find(Auth::Client()->id);
		if(isset($client->avatar)){
			$client->image = 'https://tegdarco.com/uploads/clients/images/'.$client->avatar;
		}else{
			$client->image = 'https://tegdarco.com/uploads/clients/images/avatar.png';
		}

		$validity = Package::where('id', $client->package_id)->value('validity');
		$client->package_validity = isset($client->validity) ? ($client->validity >= Carbon::now() ? 'You already have an active package. Current Package is Valid Upto '.$client->validity : 'Package Expired') :'No Package Purchased';
		$answers = DB::table('client_answers')->where('client_id',Auth::Client()->id)->exists();
		if($answers){
			$client->answers = 1;
		}else{
			$client->answers = 0;
		}
		$client_workouts = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->exists();
		$workout_days = 0;
		if ($client_workouts) {
		$workout_days = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->where('status','completed')->count('id');

		$workouts = DB::table('client_workouts')->select('client_workouts.id','exercises.id as exercise_id','calories','status')->join('exercises','exercises.id','client_workouts.exercise')->where('client_id',Auth::Client()->id)->where('status','completed')->get();
		$calories_sum = 0;
		foreach ($workouts as $key => $workout) {
			$calories_sum += explode('-', $workout->calories)[1];
		}
		}
		$client->active_days = $workout_days;
		$client->kal_burnt = $calories_sum;
		$response = ['success' => $client];
		return response($response, 200);
	}

	public function update(Request $request)
	{ 
		$user_id = Auth::User()->id;

		$validator = Validator::make($request->all(), [
			'firstname' => 'required|string|max:255',
			'lastname' => 'required|string|max:255',
			'phone' => 'required|numeric|min:11',
			'email' => 'required|string|email|max:255',
		]);

		if ($validator->fails())
		{
			return response(['errors'=>$validator->errors()->all()], 422);
		}

		$user = Client::find($user_id);
		$user->firstname = request('firstname');
		$user->lastname = request('lastname');
		$user->phone = request('phone');
		$user->gender = request('gender');
		$user->email = request('email');
		if($request->has('address')){
			$user->address = request('address');
		}

		if($request->has('image')){
			$file = $request->file('image');
			if(isset($file)) {
				$name = $file->getClientOriginalName();
				$path = time().$name;
				$profileimage = Image::make($file)->resize(150, 150);
				$pp = public_path('uploads/clients/images/');
				$profileimage->save(public_path('uploads/clients/images/'.$path),100);
				$user->avatar = $path;
			}
		}

		// echo "<pre>";print_r($user);"</pre>";exit;
		$user->save();
		$user->image = 'https://tegdarco.com/uploads/clients/images/'.$user->avatar;
		return response(['success'=> $user], 200);
	}

	public function getuserbodyprofile(Request $request){
		$user_id = Auth::Client()->id;
		if($request->language == 'arabic'){

			$questions_body_size = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',2)->get();

			$questions_health = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',3)->get();

			$questions_medicine = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',5)->get();
		}else{
			$questions_body_size = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',2)->get();
			$questions_health = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',3)->get();
			$questions_medicine = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',5)->get();	
		}


		/*if($request->language == 'arabic'){

			$questions = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->whereIn('questions.category',[2,3,5])->get();
		}else{
			$questions = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.category as question_category','questions.id as question_id','questions.question','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->whereIn('questions.category',[2,3,5])->get()
			->groupBy(function ($val) {
        return $val->question_category;
    });

		}*/

		return response([
			'success'=> 'true',
			'body_size'=> $questions_body_size,
			'health'=> $questions_health,
			'medicine'=> $questions_medicine,
		], 200);

		return response(['success'=> $questions], 200);
	}


}
