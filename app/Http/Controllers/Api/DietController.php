<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Diet;
use Carbon\Carbon;
use DB;
use Session;
use File;
use Image;

class DietController extends Controller
{
	public function intakeSubsList()
	{
		$user_id = Auth::User()->id;

		$intakeSubs = Diet::where('client_id',$user_id)->exists();

		if ($intakeSubs) {

			$intakeSubs = Diet::orderBy('created_at')->where('client_id',$user_id)->get()->groupBy(function($item) {
				return $item->diet_type;

			});

			foreach ($intakeSubs as $key => $intakeSub) {
				foreach ($intakeSub as $keyy => $value) {
					$intakeSubs[$key][$keyy]['image'] = 'https://tegdarco.com/uploads/substances/'.$value->image;
				}
			}

			return response(["success"=>$intakeSubs]);
		}else{
			return response(['errors'=>'Record not found!'], 422);
		}
	}

	public function intakeSubs(Request $request)
	{
		$user_id = Auth::User()->id;

		$validator = Validator::make($request->all(), [
			'serving_size' => 'required',
			'type' => 'required',
			'grams_per_serving' => 'required',
			'time' => 'required',
		]);

		if ($validator->fails())
		{
			return response(['errors'=>$validator->errors()->all()], 422);
		}

		$intakeSubs = new Diet;
		$intakeSubs->serving_size = request('serving_size');
		$intakeSubs->grams_per_serving = request('grams_per_serving');
		$intakeSubs->time = request('time');
		$intakeSubs->client_id = $user_id;
		$intakeSubs->diet_type = request('type');
		
		if($request->has('image')){
			$file = $request->file('image');
			if(isset($file)) {
				$name = $file->getClientOriginalName();
				$path = time().$name;
				// $profileimage = Image::make($file)->resize(300, 300);
				$profileimage = Image::make($file);
				$pp = public_path('uploads/substances/');
				// echo "<pre>";print_r(public_path('uploads/substances/'.$path));"</pre>";exit;
				$profileimage->save(public_path('uploads/substances/'.$path),100);
				$intakeSubs->image = $path;
			}
		}

		$intakeSubs->save();
		$intakeSubs->time = date('h:i A',strtotime($intakeSubs->time));
		$intakeSubs->image = 'https://tegdarco.com/uploads/substances/'.$intakeSubs->image;
		return response(['success'=> $intakeSubs], 200);

	}

	
}
