<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use DateTime;
use App\Models\Package;
use Carbon\Carbon;
use DB;
use Session;
use App\Models\Term;
use App\Models\Gdpr;
use App\Models\PrivacyPolicy;
use App\Models\AboutUs;
use File;
use Image;
use App\Models\QuestionCategory;
class AuthController extends Controller
{

	private $currencies = array();

	public function __construct() {

		$query = DB::table('currencies')->get();


		foreach ($query as $result) {
			$this->currencies[$result->code] = array(
				'currency_id'   => $result->currency_id,
				'title'         => $result->title,
				'symbol_left'   => $result->symbol_left,
				'symbol_right'  => $result->symbol_right,
				'decimal_place' => $result->decimal_place,
				'value'         => $result->value
			);
		}
	}

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

	public function forgetPasswordSms(Request $request)
	{
		$mobile_no = preg_replace(
	 '/\+(?:998|996|995|994|993|992|977|976|975|974|973|972|971|970|968|967|966|965|964|963|962|961|960|886|880|856|855|853|852|850|692|691|690|689|688|687|686|685|683|682|681|680|679|678|677|676|675|674|673|672|670|599|598|597|595|593|592|591|590|509|508|507|506|505|504|503|502|501|500|423|421|420|389|387|386|385|383|382|381|380|379|378|377|376|375|374|373|372|371|370|359|358|357|356|355|354|353|352|351|350|299|298|297|291|290|269|268|267|266|265|264|263|262|261|260|258|257|256|255|254|253|252|251|250|249|248|246|245|244|243|242|241|240|239|238|237|236|235|234|233|232|231|230|229|228|227|226|225|224|223|222|221|220|218|216|213|212|211|98|95|94|93|92|91|90|86|84|82|81|66|65|64|63|62|61|60|58|57|56|55|54|53|52|51|49|48|47|46|45|44\D?1624|44\D?1534|44\D?1481|44|43|41|40|39|36|34|33|32|31|30|27|20|7|1\D?939|1\D?876|1\D?869|1\D?868|1\D?849|1\D?829|1\D?809|1\D?787|1\D?784|1\D?767|1\D?758|1\D?721|1\D?684|1\D?671|1\D?670|1\D?664|1\D?649|1\D?473|1\D?441|1\D?345|1\D?340|1\D?284|1\D?268|1\D?264|1\D?246|1\D?242|1)\D?/'
	, ''
	, $request->mobile
	);
		$no_exists = Client::where('phone',$mobile_no)->exists();
		if ($no_exists) 
		{
			$id = config()->get('services.twilio.account_sid');
			$token = config()->get('services.twilio.auth_token');
			$url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
			$from = "+12283356343";
			$to = $request['mobile'];
			$body = $request['message'];
			$data = array (
				'From' => $from,
				'To' => $to,
				'Body' => $body,
			);
			$post = http_build_query($data);
			$x = curl_init($url );
			curl_setopt($x, CURLOPT_POST, true);
			curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
			curl_setopt($x, CURLOPT_POSTFIELDS, $post);
			$y = curl_exec($x);
			$xml = simplexml_load_string($y);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);
			if (isset($array['SMSMessage']) && !empty($array['SMSMessage'])) {
				return $response = ['success' => true,'message' => 'Message sended successfully'];
			}
			if (isset($array['RestException']) && $array['RestException']['Status'] == 400) {
				return $response = ['success' => false,'message' => $array['RestException']['Message']];
			}
		}else{
			return $response = ['success' => false,'message' => "Mobile no. doesn't exist "];
		}

		curl_close($x);
	}

	public function sendSms(Request $request)
	{
		$id = config()->get('services.twilio.account_sid');
		$token = config()->get('services.twilio.auth_token');
		$url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
		$from = "+12283356343";
		$to = $request['mobile'];
		$body = $request['message'];
		$data = array (
			'From' => $from,
			'To' => $to,
			'Body' => $body,
		);
		$post = http_build_query($data);
		$x = curl_init($url );
		curl_setopt($x, CURLOPT_POST, true);
		curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
		curl_setopt($x, CURLOPT_POSTFIELDS, $post);
		$y = curl_exec($x);
		$xml = simplexml_load_string($y);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		if (isset($array['SMSMessage']) && !empty($array['SMSMessage'])) {
			return $response = ['success' => true,'message' => 'Message sended successfully'];
		}
		if (isset($array['RestException']) && $array['RestException']['Status'] == 400) {
			return $response = ['success' => false,'message' => $array['RestException']['Message']];
		}

		curl_close($x);
	}

	public function getHomeData()
	{
		$user_id = Auth::Client()->id;
		$user = Client::find($user_id);		

		$client_workouts = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->exists();
		$calories_sum = 0;
		$workout_days = 0;
		if ($client_workouts) {
			$workout_data = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->orderBy('day', 'asc')->first();

			$fdate = $workout_data->created_at;
			$tdate = Now();
			$datetime1 = new DateTime($fdate);
			$datetime2 = new DateTime($tdate);
			$interval = $datetime1->diff($datetime2);
			$active_day = $interval->format('%a');
			// $active_day = 3;

			$workout_exercise = DB::table('client_workouts')->select('client_workouts.id','exercises.id as exercise_id','exercises.name')->join('exercises','exercises.id','client_workouts.exercise')->where('client_id',Auth::Client()->id)->where('day',$active_day)->first();

			if ($workout_exercise) {
				$workout_name = $workout_exercise->name;
			}else{
				$workout_name = '---';
			}

			$workout_days = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->where('status','completed')->count('id');

			$workouts = DB::table('client_workouts')->select('client_workouts.id','exercises.id as exercise_id','calories','status')->join('exercises','exercises.id','client_workouts.exercise')->where('client_id',Auth::Client()->id)->where('status','completed')->get();

			foreach ($workouts as $key => $workout) {
				$calories_sum += explode('-', $workout->calories)[1];
			}
		}else{
			return $response = ['success' => false,'message' => 'No data found'];
		}

		$validity = $user->validity;

		$date = new Carbon;
		if($date > $validity)
		{
			return $response = ['success' => false,'message' => 'Package expired'];
		} 

		return $response = ['success' => true,'active_day' => $active_day,'validity' => $validity, 'kal_burnt' => $calories_sum,'exercises'=>$workout_days,'workout'=>$workout_name];
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

	public function checkPhone(Request $request)
	{
		
		$user_id = Auth::Client()->id;

		$user = Client::find($user_id);

		if (isset($user->phone) && !empty($user->phone)) {
			return $response = ['success' => 'true','message' => "Phone number exists"];
		}else{
			return $response = ['success' => false,'message' => "Phone number not exists"];
		}
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

			if ($current_package->package_id == $request->package_id) {
				$current_validity = $current_package->validity;

				$date = date_create($current_validity);

				date_add($date, date_interval_create_from_date_string("$validity days")); 

				$valid_upto =  date_format($date, "Y-m-d"); 

				Client::where('id',$user_id)->update(['package_id' => $request->package_id, 'validity' => $valid_upto]);

				DB::table('transactions')->insert(['client_id' => $user_id, 'package_id' => $request->package_id, 'transaction_id' =>$request->transaction_id, 'amount' => $request->amount ]);
				$response = ['success' => 'This package has been assigned to you..!'];
			}else{
				$valid_upto = Carbon::now()->addDays($validity);

				Client::where('id',$user_id)->update(['package_id' => $request->package_id, 'validity' => $valid_upto]);

				DB::table('transactions')->insert(['client_id' => $user_id, 'package_id' => $request->package_id, 'transaction_id' =>$request->transaction_id, 'amount' => $request->amount ]);
				$response = ['success' => 'This package has been assigned to you..!'];
			}

			// $response = ['success' => 'You already have an active package. Current Package is Valid Upto '.$current_package->validity];
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

	public function faqs(){
		$faqs = DB::table('faqs')->where('status',1)->latest('id')->get();
		unset($faqs->slug);
		$response = ['success' => $faqs];
		return response($response, 200);
	}

	public function privacyPolicy(){
		$privacypolicy = PrivacyPolicy::first();
		$response = ['success' => $privacypolicy];
		return response($response, 200);
	}

	public function terms(){
		$terms = Term::first();
		$response = ['success' => $terms];
		return response($response, 200);
	}


	public function about(){
		$about_us = AboutUs::first();
		$response = ['success' => $about_us];
		return response($response, 200);
	}

	public function gdpr(){
		$gdpr = Gdpr::first();
		$response = ['success' => $gdpr];
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
		$calories_sum = 0;
		$workout_days = 0;
		if ($client_workouts) {
			$workout_days = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->where('status','completed')->count('id');

			$workouts = DB::table('client_workouts')->select('client_workouts.id','exercises.id as exercise_id','calories','status')->join('exercises','exercises.id','client_workouts.exercise')->where('client_id',Auth::Client()->id)->where('status','completed')->get();
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

			$questions_body_size = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','questions.question_type','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',2)->get();

			$questions_health = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','questions.question_type','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',3)->get();

			$questions_medicine = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','questions.question_type','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',5)->get();
		}else{
			$questions_body_size = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','questions.question_type','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',2)->get();
			$questions_health = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','questions.question_type','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',3)->get();
			$questions_medicine = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','questions.question_type','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',5)->get();	
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

	public function currencyConverter(Request $request)
	{
		$packages = Package::all();
		$amount=$request->amount;
		$from=$request->from;
		$to=$request->to;
		$amount_re = $this->currency_converter($from,$to,$amount);
		return response(['success'=> true,'amount'=>$amount_re], 200);
	}

	public function currency_converter($from,$to,$amount)
	{
		$symbol_left = $this->currencies[$to]['symbol_left'];
		$symbol_right = $this->currencies[$to]['symbol_right'];

		$decimal_place = $this->currencies[$to]['decimal_place'];

		if (isset($this->currencies[$from])) {
			$from = $this->currencies[$from]['value'];
		} else {
			$from = 1;
		}

		if (isset($this->currencies[$to])) {
			$to = $this->currencies[$to]['value'];
		} else {
			$to = 1;
		}


		return number_format($amount * ($to / $from), (int)$decimal_place);

		/*$string = '';

		if ($symbol_left) {
			$string .= $symbol_left;
		}

		$string .= $amount;

		if ($symbol_right) {
			$string .= $symbol_right;
		}

		return $string;*/


	} 
}
