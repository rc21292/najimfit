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

			foreach ($intakeSubs as $key => $intakeSub) 
			{
				foreach ($intakeSub as $keyy => $value) 
				{
					$comments = DB::table('intake_substance_comments')->orderBy('created_at')->where('intake_subs_id', $value->id)->get();

					$images = DB::table('intake_substance_images')->orderBy('created_at')->where('intake_substance_id', $value->id)->get();

					foreach ($images as $image_key => $image) {
						$images[$image_key]->image = 'https://tegdarco.com/uploads/substances/'.$image->image;
					}

					if (count($images) > 0) {
						$intakeSubs[$key][$keyy]['image'] = $images;
					}else{
						$intakeSubs[$key][$keyy]['image'] = 'https://tegdarco.com/uploads/substances/diet-default.png';
					}

					if (count($comments) > 0) {
						DB::enableQueryLog();
						foreach ($comments as $comment_key => $comment) {
							if ($comment->flag == 'nutri_client') {
								$user_name = DB::table('users')->where('id',$comment->client_id)->value('name');
								$comment_by_user = false;
							}else{
								$user_name = DB::table('clients')->where('id',$comment->client_id)->value('firstname').' '.DB::table('clients')->where('id',$comment->client_id)->value('lastname');
								$comment_by_user = true;
							}
							// dd(DB::getQueryLog());
							$comments[$comment_key]->name = $user_name;
							$comments[$comment_key]->comment_by_user = $comment_by_user;
						}
						$intakeSubs[$key][$keyy]['comments'] = $comments;
					}
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
		$intakeSubs->image = '';

		$intakeSubs->save();

		if (request('comment') && !empty(request('comment'))) {
			$flag = 'client_nutri';
			DB::table('intake_substance_comments')->insert(['client_id'=>$user_id,'intake_subs_id'=>$intakeSubs->id,'flag'=>$flag,'comment'=>request('comment')]);
		}

		$images=array();
		if($files=$request->file('image')){
			foreach($files as $file){
				$name=$file->getClientOriginalName();
				$path = time().$name;
				$profileimage = Image::make($file);
				$pp = public_path('uploads/substances/');
				$profileimage->save(public_path('uploads/substances/'.$path),100);
				DB::table('intake_substance_images')->insert(['intake_substance_id'=>$intakeSubs->id,'image'=>$path]);
			}
		}

		/*$intakeSubs->time = date('h:i A',strtotime($intakeSubs->time));
		$intakeSubs->image = 'https://tegdarco.com/uploads/substances/'.$intakeSubs->image;*/
		return response(['success'=> true], 200);

	}


	public function intakeSubsComment(Request $request)
	{
		$user_id = Auth::User()->id;


		$validator = Validator::make($request->all(), [
			'comment' => 'required',
			'intake_subs_id' => 'required',
		]);

		if ($validator->fails())
		{
			return response(['errors'=>$validator->errors()->all()], 422);
		}

		$flag = 'client_nutri';

		DB::table('intake_substance_comments')->insert(['client_id'=>$user_id,'intake_subs_id'=>$request->intake_subs_id,'flag'=>$flag,'comment'=>$request->comment]);

		return response(['success'=> true], 200);
	}
	
}
