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
use App\Models\User;
use Carbon\Carbon;
use DB;
use Session;
use App\Models\Term;
use App\Models\Gdpr;
use App\Models\PrivacyPolicy;
use App\Models\AboutUs;
use File;
use Image;
use App\Models\ClientTable;
use App\Models\Meals\Meal;
use App\Models\Meals\TableCategory;
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

	public function register(Request $request) {
		$validator = Validator::make($request->all(), [
			'firstname' => 'required|string|max:255',
			'lastname' => 'required|string|max:255',
			'phone' => 'required|numeric|min:11',
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|min:6',
		]);
		if ($validator->fails())
		{
			$array = implode(',', $validator->errors()->all());
			return response(["success"=> 0,'message'=>$array], 422);
		}

		$validator = Validator::make($request->all(), [
			'phone' => 'unique:clients',
		]);
		if ($validator->fails())
		{
			$array = implode(',', $validator->errors()->all());
			if ($request->language == "arabic") {
				return response(["success"=> 2,"message"=>"رقم الهاتف المحمول مأخوذ بالفعل"], 422);
			}
			return response(["success"=> 2,"message"=>"Mobile number is already taken"], 422);
		}

		$validator = Validator::make($request->all(), [
			'email' => 'unique:clients'
		]);
		if ($validator->fails())
		{
			$array = implode(',', $validator->errors()->all());
			if ($request->language == "arabic") {
				return response(["success"=> 2,"message"=>"تم إستلام البريد الإلكتروني"], 422);
			}
			return response(["success"=> 2,"message"=>"Email is already taken"], 422);
		}

		$request['password']=Hash::make($request['password']);
		$request['remember_token'] = Str::random(10);
		$user = Client::create($request->toArray());
		$nutritionists = DB::table('nutritionist_clients')
		->select('nutritionist_id', DB::raw('count(*) as client_total'))
		->groupBy('nutritionist_id')
		->get();

		DB::table('clients')->where('id',$user->id)->update(['device_token' => $request['device_token']]);   

		foreach($nutritionists as $nutritionist){
			if($nutritionist->client_total < 6){
				DB::table('nutritionist_clients')->insert(['client_id'=>$user->id,'table_status'=>'due','workout_status'=>'due','nutritionist_id'=>$nutritionist->nutritionist_id]);
				break;
			}
		}
		$token = $user->createToken('Laravel Password Grant Client')->accessToken;
		$response = ["success"=> 1,"message" => "User registred successfully",'token' => $token];
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
			$id = config('services.twilio.account_sid');
			$token = config('services.twilio.auth_token');
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
		$id = config('services.twilio.account_sid');
		$token = config('services.twilio.auth_token');
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

	public function getHomeData(Request $request)
	{
		$user_id = Auth::Client()->id;
		$user = Client::find($user_id);

		$package = Package::find(Auth::Client()->package_id);

		$client_workouts = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->exists();
		$calories_sum = 0;
		$workout_days = 0;
		$assign_date = '';
		if ($client_workouts) {
			$workout_data = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->orderBy('day', 'asc')->first();

			$fdate = $workout_data->created_at;
			$assign_date = $workout_data->created_at;
			$tdate = Now();

			if ($request->date) {
				$tdate21 = date('Y-m-d H:i:s',strtotime($request->date));
			}else{
				$tdate21 = Now();
			}			

			$datetime1 = new DateTime($fdate);
			// $datetime2 = new DateTime($tdate);
			$datetime2 = new DateTime($tdate21);

			$interval = $datetime1->diff($datetime2);
			$active_day = $interval->format('%a');
			if ($datetime2 < $datetime1) {
				$active_day = 0;
			}
			// $active_day = 3;			

			$workout_exercise = DB::table('client_workouts')->select('client_workouts.id','exercises.id as exercise_id','exercises.name')->join('exercises','exercises.id','client_workouts.exercise')->where('client_id',Auth::Client()->id)->where('day',$active_day)->first();

			if ($workout_exercise) {
				$workout_name = $workout_exercise->name;
			}else{
				$workout_name = ($request->language == "arabic") ? "غيرمعتمد" :'Not Assigned';
			}

			$workout_days = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->where('status','completed')->where('day',$active_day)->count('id');
			
			/*$workout_days = DB::table('client_workouts')->where('client_id',Auth::Client()->id)->where('status','completed')->count('id');*/

			$workouts = DB::table('client_workouts')->select('client_workouts.id','exercises.id as exercise_id','calories','status')->join('exercises','exercises.id','client_workouts.exercise')->where('client_id',Auth::Client()->id)->where('status','completed')->where('day',$active_day)->get();

			foreach ($workouts as $key => $workout) {
				$calories_sum += explode('-', $workout->calories)[1];
			}
		}else{
			return $response = ['success' => false,'message' => 'No data found'];
		}

		// $calories_sum = $this->calCaloryBurntOld(Auth::Client()->id);
		$calories_sum = $this->calCaloryBurnt(Auth::Client()->id);

		$validity = $user->validity;
		$package_subscription_date = $user->subscription_date;

		$date = new Carbon;
		if($date > $validity)
		{
			return $response = ['success' => false,'message' => 'Package expired'];
		} 

		return $response = ['success' => true,'active_day' => $active_day,'validity' => $validity, 'kal_burnt' => $calories_sum,'exercises'=>$workout_days,'workout'=>$workout_name,'workout_days' => $package['workout_days'],'off_days' => $package['off_days'], 'assign_date' => $assign_date, 'package_subscription_date' => $package_subscription_date];
	}

	public function calCaloryBurnt($client_id)
	{
		$table = ClientTable::where('client_id',$client_id)->first();

		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			// unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);


			$table->category = TableCategory::find($category)->name;

			$data_breakfast = explode(', ', $breakfast);

			$table_break_fast = [];

			foreach ($data_breakfast as $key => $breakfast) 
			{
				$breakfast_detail =Meal::find($breakfast);
				$table_break_fast[$key]['breakfast_name'] = $breakfast_detail->food;
				$table_break_fast[$key]['breakfast_calories'] = $breakfast_detail->calories;
			}

			$i = 0;
			$breakfast_group = array();
			$breakfast_group_add = array();
			$j = 1;
			foreach ($table_break_fast as $key1 => $value1) {
				if($i % 4 == 0 ) {
					$j++;
					$i=0;
					$table_breakfast_calories =0;
					$breakfast_group_add = array();
				}

				$table_breakfast_calories += $value1['breakfast_calories'];

				$breakfast_group[$j]['groups'][]['foodDetails'] = array(
					'foodName' => $value1['breakfast_name'],
					'foodCallery' => $value1['breakfast_calories'],

				);
				$breakfast_group[$j]['calorie'] = $table_breakfast_calories;
				array_push($breakfast_group_add, $value1['breakfast_calories']);
				$breakfast_group[$j]['calorie_arr'] = $breakfast_group_add;

				$i++;
			}


			foreach ($breakfast_group as $key => $value) {
				$breakfast_group[$key]['calorie_min'] = min($value['calorie_arr']);
				$breakfast_group[$key]['calorie_max'] = max($value['calorie_arr']);
				unset($breakfast_group[$key]['calorie_arr']);
			}


			$value_max = array_sum(array_column($breakfast_group,'calorie_max'));
			$value_min = array_sum(array_column($breakfast_group,'calorie_min'));

			foreach ($breakfast_group as $key => $value) {
				$breakfast_group['min'] = $value_min;
				$breakfast_group['max'] = $value_max;
			}


			$data_snacks1 = explode(', ', $snacks1);

			$table_data_snacks1 = [];

			foreach ($data_snacks1 as $key => $snacks1) 
			{
				$snacks1_detail =Meal::find($snacks1);
				$table_data_snacks1[$key]['snacks_name'] = $snacks1_detail->food;
				
				$table_data_snacks1[$key]['snacks_calories'] = $snacks1_detail->calories;
			}

			$i = 0;
			$snacks_group = array();
			$snacks_group_add = array();
			$j = 1;
			foreach ($table_data_snacks1 as $key1 => $value1) {
				if($i % 4 == 0 ) {
					$j++;
					$i=0;
					$table_snacks_calories =0 ;
					$snacks_group_add = array();
				}

				$table_snacks_calories += $value1['snacks_calories'];
				array_push($snacks_group_add, $value1['snacks_calories']);

				$snacks_group[$j]['groups'][]['foodDetails'] = array(
					'foodName' => $value1['snacks_name'],
					'foodCallery' => $value1['snacks_calories'],

				);
				$snacks_group[$j]['calorie'] = $table_snacks_calories;
				$snacks_group[$j]['calorie_arr'] = $snacks_group_add;

				$i++;
			}

			foreach ($snacks_group as $key => $value) {
				$snacks_group[$key]['calorie_min'] = min($value['calorie_arr']);
				$snacks_group[$key]['calorie_max'] = max($value['calorie_arr']);
				unset($snacks_group[$key]['calorie_arr']);
			}


			$value_max = array_sum(array_column($snacks_group,'calorie_max'));
			$value_min = array_sum(array_column($snacks_group,'calorie_min'));

			foreach ($snacks_group as $key => $value) {
				$snacks_group['min'] = $value_min;
				$snacks_group['max'] = $value_max;
			}


			$data_lunch = explode(', ', $lunch);

			$table_data_lunch = [];

			foreach ($data_lunch as $key => $lunch) 
			{
				$lunch_detail =Meal::find($lunch);
				$table_data_lunch[$key]['lunch_name'] = $lunch_detail->food;
				$table_data_lunch[$key]['lunch_calories'] = $lunch_detail->calories;
			}

			$i = 0;
			$lunch_group = array();
			$lunch_group_add = array();
			$j = 1;
			foreach ($table_data_lunch as $key1 => $value1) {
				if($i % 4 == 0 ) {
					$j++;
					$i=0;
					$table_lunch_calories =0;
					$lunch_group_add = array();
				}

				$table_lunch_calories += $value1['lunch_calories'];

				$lunch_group[$j]['groups'][]['foodDetails'] = array(
					'foodName' => $value1['lunch_name'],
					'foodCallery' => $value1['lunch_calories'],

				);

				array_push($lunch_group_add, $value1['lunch_calories']);
				$lunch_group[$j]['calorie_arr'] = $lunch_group_add;

				$lunch_group[$j]['calorie'] = $table_lunch_calories;

				$i++;
			}


			foreach ($lunch_group as $key => $value) {
				$lunch_group[$key]['calorie_min'] = min($value['calorie_arr']);
				$lunch_group[$key]['calorie_max'] = max($value['calorie_arr']);
				unset($lunch_group[$key]['calorie_arr']);
			}


			$value_max = array_sum(array_column($lunch_group,'calorie_max'));
			$value_min = array_sum(array_column($lunch_group,'calorie_min'));

			foreach ($lunch_group as $key => $value) {
				$lunch_group['min'] = $value_min;
				$lunch_group['max'] = $value_max;
			}

			$data_dinner = explode(', ', $dinner);

			$table_data_dinner = [];

			foreach ($data_dinner as $key => $dinner) 
			{
				$dinner_detail =Meal::find($dinner);
				$table_data_dinner[$key]['dinner_name'] = $dinner_detail->food;
				$table_data_dinner[$key]['dinner_calories'] = $dinner_detail->calories;
			}

			$i = 0;
			$dinner_group = array();
			$dinner_group_add = array();
			$j = 1;
			foreach ($table_data_dinner as $key1 => $value1) {
				if($i % 4 == 0 ) {
					$j++;
					$i=0;
					$table_dinner_calories =0;
					$dinner_group_add = array();
				}

				$table_dinner_calories += $value1['dinner_calories'];

				$dinner_group[$j]['groups'][]['foodDetails'] = array(
					'foodName' => $value1['dinner_name'],
					'foodCallery' => $value1['dinner_calories'],

				);
				$dinner_group[$j]['calorie'] = $table_dinner_calories;
				array_push($dinner_group_add, $value1['dinner_calories']);
				$dinner_group[$j]['calorie_arr'] = $dinner_group_add;

				$i++;
			}


			foreach ($dinner_group as $key => $value) {
				$dinner_group[$key]['calorie_min'] = min($value['calorie_arr']);
				$dinner_group[$key]['calorie_max'] = max($value['calorie_arr']);
				unset($dinner_group[$key]['calorie_arr']);
			}


			$value_max = array_sum(array_column($dinner_group,'calorie_max'));
			$value_min = array_sum(array_column($dinner_group,'calorie_min'));

			foreach ($dinner_group as $key => $value) {
				$dinner_group['min'] = $value_min;
				$dinner_group['max'] = $value_max;
			}


			/// Mustaqueem -- Do same for other diets
			$i= 1;
			$data_min = 0;
			$data_max = 0;

			$data_min = $breakfast_group['min']+$lunch_group['min']+$dinner_group['min']+$snacks_group['min'];
			$data_max = $breakfast_group['max']+$lunch_group['max']+$dinner_group['max']+$snacks_group['max'];

			return $data_min.'-'.$data_max;

			
		}
	}

	public function calCaloryBurntOld($client_id)
	{

		$table = ClientTable::where('client_id',$client_id)->first();

		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$dinner= $table->dinner;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);


			$table->category = TableCategory::find($category)->name;

			$data_breakfast = explode(', ', $breakfast);

			$table_break_fast = [];

			foreach ($data_breakfast as $key => $breakfast) 
			{
				$breakfast_detail =Meal::find($breakfast);
				$table_break_fast[$key]['breakfast_calories'] = $breakfast_detail->calories;
			}

			$table_data_breakfast_max = max(array_column($table_break_fast,'breakfast_calories'));
			$table_data_breakfast_min = min(array_column($table_break_fast,'breakfast_calories'));

			$data_snacks1 = explode(', ', $snacks1);

			$table_data_snacks1 = [];

			foreach ($data_snacks1 as $key => $snacks1) 
			{
				$snacks1_detail =Meal::find($snacks1);

				$table_data_snacks1[$key]['snacks_calories'] = $snacks1_detail->calories;
			}

			$table_data_snacks1_max = max(array_column($table_data_snacks1,'snacks_calories'));
			$table_data_snacks1_min = min(array_column($table_data_snacks1,'snacks_calories'));


			$data_lunch = explode(', ', $lunch);

			$table_data_lunch = [];

			foreach ($data_lunch as $key => $lunch) 
			{
				$lunch_detail =Meal::find($lunch);
				$table_data_lunch[$key]['lunch_calories'] = $lunch_detail->calories;
			}

			$table_data_lunch_max = max(array_column($table_data_lunch,'lunch_calories'));
			$table_data_lunch_min = min(array_column($table_data_lunch,'lunch_calories'));

			$data_dinner = explode(', ', $dinner);

			$table_data_dinner = [];

			foreach ($data_dinner as $key => $dinner) 
			{
				$dinner_detail =Meal::find($dinner);
				$table_data_dinner[$key]['dinner_calories'] = $dinner_detail->calories;
			}

			$table_data_dinner_max = max(array_column($table_data_dinner,'dinner_calories'));
			$table_data_dinner_min = min(array_column($table_data_dinner,'dinner_calories'));
	
			$i= 1;
			$cal_max = 0;
			$cal_min = 0;

			$cal_max = $table_data_dinner_max+$table_data_lunch_max+$table_data_snacks1_max+$table_data_breakfast_max;
			$cal_min = $table_data_dinner_min+$table_data_lunch_min+$table_data_snacks1_min+$table_data_breakfast_min;
		

			return $cal_min.'-'.$cal_max;


		}
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

		$close_subscriptions = DB::table('subscription_settings')->value('close_subscriptions');

		if ($close_subscriptions) {
			return $response = ['success' => false,'message' => ($request->language == "arabic") ? "الاشتراكات مغلقة الآن!" : 'Subscriptions are closed now!'];
		}

		$packages = Package::all();
		foreach ($packages as $row) {

			if ($request->currency) {
				$amount=$row->price;
				$from='SAR';
				$to=$request->currency;
				$amount_re = $this->currency_converter($from,$to,$amount);				
			}else{
				$amount_re = $row->price;
			}

			$allpackages[] = array(
				'id'  => $row->id,
				'name'  => $request->language == "arabic" ? $row->name_arabic : $row->name,
				'price'  => $amount_re,
				'validity'  => $row->validity.' days',
				'workout_days'  => $row->workout_days,
				'off_days'  => $row->off_days,
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
		// echo "<pre>";print_r($user_id);"</pre>";exit;
		$current_package = Client::find($user_id);

		$subscription_settings = DB::table('subscription_settings')->first();

		$is_subscription_in_wating = 0;

		if ($subscription_settings->subscriptions_reached >= $subscription_settings->subscriptions_limit) 
		{
			if ($subscription_settings->subscriptions_wating_list_reached >= $subscription_settings->subscriptions_watinglist_limit) 
			{
				DB::table('subscription_settings')->update(['accept_subscriptions'=>0]);
				DB::table('subscription_settings')->update(['close_subscriptions'=>1]);
			}else
			{
				DB::table('subscription_settings')->update(['subscriptions_wating_list_reached'=> DB::raw('subscriptions_wating_list_reached+1')]);
				$is_subscription_in_wating = 1;
			}
		}else
		{
			DB::table('subscription_settings')->update(['subscriptions_reached'=> DB::raw('subscriptions_reached+1')]);
		}

		$validity = Package::where('id', $request->package_id)->value('validity');
		if($current_package->validity >= Carbon::now()){

			if ($current_package->package_id == $request->package_id) {
				$current_validity = $current_package->validity;

				$date = date_create($current_validity);

				date_add($date, date_interval_create_from_date_string("$validity days")); 

				$valid_upto =  date_format($date, "Y-m-d"); 

				$today_date = date('Y-m-d');

				Client::where('id',$user_id)->update(['package_id' => $request->package_id, 'validity' => $valid_upto,'is_subscription_in_wating' => $is_subscription_in_wating,'subscription_wating_datetime'=>now()]);

				DB::table('transactions')->insert(['client_id' => $user_id, 'package_id' => $request->package_id, 'transaction_id' =>$request->transaction_id, 'amount' => $request->amount ]);
				$response = ['success' => 'This package has been assigned to you..!'];
			}else{
				$valid_upto = Carbon::now()->addDays($validity);
				$today_date = date('Y-m-d');

				Client::where('id',$user_id)->update(['package_id' => $request->package_id, 'validity' => $valid_upto, 'subscription_date' => $today_date,'is_subscription_in_wating' => $is_subscription_in_wating,'subscription_wating_datetime'=>now()]);

				DB::table('transactions')->insert(['client_id' => $user_id, 'package_id' => $request->package_id, 'transaction_id' =>$request->transaction_id, 'amount' => $request->amount ]);
				$response = ['success' => 'This package has been assigned to you..!'];
			}

			// $response = ['success' => 'You already have an active package. Current Package is Valid Upto '.$current_package->validity];
		}else{

			$valid_upto = Carbon::now()->addDays($validity);
			$today_date = date('Y-m-d');

			Client::where('id',$user_id)->update(['package_id' => $request->package_id, 'validity' => $valid_upto, 'subscription_date' => $today_date,'is_subscription_in_wating' => $is_subscription_in_wating,'subscription_wating_datetime'=>now()]);

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
			if ($user->blocked_from_app) {
				return $response = ['message' => 'You are blocked by admin!'];
			}
			if (Hash::check($request->password, $user->password)) {
				$token = $user->createToken('Laravel Password Grant Client')->accessToken;
				DB::table('clients')->where('id',$user->id)->update(['device_token' => $request['device_token']]);   
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
		/*if ($client->blocked_from_app) {
			return $response = ['success' => false,'message' => 'You are blocked by admin!'];
		}*/
		if(isset($client->avatar) && !empty($client->avatar)){
			$client->image = 'https://tegdarco.com/uploads/clients/images/'.$client->avatar;
		}else{
			// $client->image = 'https://tegdarco.com/uploads/clients/images/avatar.png';
			if ($client->gender == "male") {
				$client->image = 'https://tegdarco.com/uploads/user/male.png';
			}else{
				$client->image = 'https://tegdarco.com/uploads/user/images/user/female.png';
			}
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
		/*if user subscription canceled*/
		if ($client->is_subscription_canceled) {
			$client->package_id = 0;
			$client->validity = '';
			$client->package_validity = 'Your subscription is canceled by Admin';
			$client->subscription_date = '';
		}
		/*if user subscription canceled*/
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
		$user->country = request('country');
		$user->city = request('city');
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

		$user->save();
		$user->image = 'https://tegdarco.com/uploads/clients/images/'.$user->avatar;
		return response(['success'=> $user], 200);
	}

	public function getuserbodyprofile(Request $request){
		$user_id = Auth::Client()->id;
		if($request->language == 'arabic'){

			$questions_body_size = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','questions.question_type','questions.arabic_hint','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',2)->get();

			$questions_health = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','questions.question_type','questions.arabic_hint','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.question','Do you have any health issue?')->where('questions.category',3)->get();

			$questions_medicine = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question_arabic','questions.question_type','questions.arabic_hint','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',3)->where('questions.hint','Medication name')->get();
		}else{
			$questions_body_size = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','questions.question_type','questions.hint','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',2)->get();
			$questions_health = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','questions.question_type','questions.hint','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.question','Do you have any health issue?')->where('questions.category',3)->get();
			$questions_medicine = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.id as question_id','questions.question','questions.question_type','questions.hint','client_answers.id as answer_id' , 'client_answers.answer')->where('client_answers.client_id', $user_id)->where('questions.category',3)->where('questions.hint','Medication name')->get();	
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
	
	public function nutritionistDetail(Request $request)
	{
		$nutritionists = DB::table('nutritionist_clients')
		->join('users','users.id','nutritionist_clients.nutritionist_id')
		->select('users.id','users.nutritionist_id as reffernce_number','users.name','users.email','users.avater')
		->where('client_id', Auth::user()->id)
		->first();
		$nutritionists->avater = 'https://tegdarco.com/uploads/user/'.$nutritionists->avater;
		return response(['success'=> true,'message'=>'nutritionist detail','data' => $nutritionists], 200);
	}

	public function nutritionistList(Request $request)
	{
		$users = User::select('id','nutritionist_id as reffernce_number','name','email')->where('id', '!=' , 1)->get();
		return response(['success'=> true,'message'=>'nutritionist fetched','data' => $users], 200);
	}
}
