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
use PragmaRX\Countries\Package\Countries;
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
			return response(['errors'=>$validator->errors()->all()], 422);
		}
		$request['password']=Hash::make($request['password']);
		$request['remember_token'] = Str::random(10);
		$user = Client::create($request->toArray());
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
			return response(['errors'=>$validator->errors()->all()], 422);
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

			DB::table('transactions')->insert(['client_id' => $user_id, 'package_id' => $request->package_id, 'transaction_id' =>$request->transaction_id, 'amount' => Session::get('total') ]);
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
			return response(['errors'=>$validator->errors()->all()], 422);
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
	public function getuserdetails(){
		$client = Client::find(Auth::Client()->id);
		$validity = Package::where('id', $client->package_id)->value('validity');
		$client->package_validity = isset($client->validity) ? ($client->validity >= Carbon::now() ? 'You already have an active package. Current Package is Valid Upto '.$client->validity : 'Package Expired') :'No Package Purchased';
		$client_details[]=array(
			'id'=>$client->id,
			'firstname'=>$client->firstname,
			'lastname'=>$client->lastname,
			'gender'=>$client->gender,
			'email'=>$client->email,
			'phone'=>$client->phone,
			'added_on'=>$client->created_at,
			'package_status'  => isset($client->validity) ? ($client->validity >= Carbon::now() ? 'You already have an active package. Current Package is Valid Upto '.$client->validity : 'Package Expired') :'No Package Purchased',
		);
		$response = ['success' => $client];
		return response($response, 200);
	}


}
