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
use File;
use Image;

class SubscriptionController extends Controller
{
	public function subscriptions(){

		$client = Client::find(Auth::id());
		if(isset($client->package_id)){
			$client->current_package_id = $client->package_id;
			$client->current_package_name = Package::find($client->package_id)->name;
			$client->current_package_validity = $client->validity;
			$client->current_package_subscription_date = $client->subscription_date;
			$datework = Carbon::createFromDate($client->validity);
			$now = Carbon::now();
			$days = $datework->diffInDays($now);
			$client->days = $days." Days Remaining";
			$client->member_since = $client->created_at->format('Y-m-d');
			unset($client->id);
			unset($client->firstname);
			unset($client->lastname);
			unset($client->phone);
			unset($client->gender);
			unset($client->email);
			unset($client->active_status);
			unset($client->dark_mode);
			unset($client->id);
			unset($client->messenger_color);
			unset($client->address);
			unset($client->package_id);
			unset($client->validity);
			unset($client->package_id);
			unset($client->subscription_date);
			unset($client->email_verified_at);
			unset($client->avatar);
			unset($client->status);
			unset($client->created_at);
			unset($client->updated_at);

			$response = ['success' => $client];
			return response($response, 200);
		}else{
			$response = ['message' => "Please Subscribe to Package first"];
			return response($response, 422);
		}

	}
}
