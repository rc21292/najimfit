<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Session;
use Auth;
use App\Models\Diet;
use App\Models\User;
use App\Models\ClientTable;
use App\Models\Package;
use App\Models\Client;
use App\Helper;

class IntakeSubstanceController extends Controller
{

    public function sendNotice($value='')
    {
         $user = Client::where('id', $id)->first();

        // $notification_id = $user->notification_id;
        $notification_id = 1;
        $title = "Greeting Notification";
        $message = "Have good day!";
        $id = $user->id;
        $type = "basic";

        $res = \App\Helper::send_notification_FCM($notification_id, $title, $message, $id,$type);

        if($res == 1){

            echo "<pre>";print_r('sjsjjs');"</pre>";exit;
        }else{
            echo "<pre>";print_r('error');"</pre>";exit;
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist')
        {
             $intake_subs = Diet::select('intake_substances.client_id','clients.firstname','clients.lastname','users.name')->join('nutritionist_clients','nutritionist_clients.client_id','=','intake_substances.client_id')->join('clients','clients.id','=','intake_substances.client_id')->join('users','users.id','=','nutritionist_clients.nutritionist_id')->where('nutritionist_clients.nutritionist_id', $user->id)->distinct()->get();

        }else{
            $intake_subs = Diet::exists();

            if ($intake_subs) {

                $intake_subs = Diet::select('intake_substances.client_id','clients.firstname','clients.lastname','users.name')->join('clients','clients.id','=','intake_substances.client_id')->join('nutritionist_clients','nutritionist_clients.client_id','=','intake_substances.client_id')->join('users','users.id','=','nutritionist_clients.nutritionist_id')->distinct()->get();
            }
        }

        // echo "<pre>";print_r($intake_subs->toArray());"</pre>";exit;

        return view('backend.admin.intake-substances.index',compact('intake_subs'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::User()->id;

        $flag = 'nutri_client';


        // insertGetId

        DB::table('intake_substance_comments')->insert(['client_id'=>$request->client_id,'intake_subs_id'=>$request->intake_substance_id,'flag'=>$flag,'comment'=>$request->content, 'time_stamp' => \Carbon\Carbon::now()->timestamp]);

        // return redirect()->route('view-comments',$request->intake_substance_id)
        // ->with('success','Client Updated successfully');

        return response(['success'=> true, 'message' => 'comment inserted successfully'], 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intake_subs = Diet::exists();

        if ($intake_subs) {

            $intake_subs = Diet::orderBy('created_at')->where('client_id',$id)->get()->groupBy(function($item) {
                return $item->diet_type;
            });
        }

        return view('backend.admin.intake-substances.show',compact('intake_subs'))->with('no', 1);
    }

    public function viewComments($id)
    {

        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist'){

            $intake_subs = Diet::exists();

            if ($intake_subs) {

                $intake_subs = Diet::leftJoin('intake_substance_images','intake_substance_images.intake_substance_id','intake_substances.id')->where('intake_substances.id',$id)->first();
            }

            $client = Client::find($intake_subs->client_id);

            $client_table = ClientTable::select('calories','carbs','protein','fat')->where('client_id',$intake_subs->client_id)->first();

            $package = Package::where('id',$client->package_id)->value('name');

            $weight = DB::table('client_answers')->where('client_id',$intake_subs->client_id)->where('question_id',9)->value('answer');

            $height = DB::table('client_answers')->where('client_id',$intake_subs->client_id)->where('question_id',10)->value('answer');

            $comments = DB::table('intake_substance_comments')->orderBy('created_at')->where('intake_subs_id', $id)->get();

            if (count($comments) > 0) {
                foreach ($comments as $comment_key => $comment) {
                    if ($comment->flag == 'nutri_client') {
                        $user_name = DB::table('users')->where('id',$comment->client_id)->value('name');
                        $comment_by_user = false;
                    }else{
                        $user_name = DB::table('clients')->where('id',$comment->client_id)->value('firstname').' '.DB::table('clients')->where('id',$comment->client_id)->value('lastname');
                        $comment_by_user = true;
                    }
                    $comments[$comment_key]->name = $user_name;
                    $comments[$comment_key]->comment_by_user = $comment_by_user;
                }
                $intake_subs['comments'] = $comments;
            }else{
                $intake_subs['comments'] = '';
            }               

            // echo "<pre>";print_r($intake_subs->toArray());"</pre>";exit;
            return view('backend.admin.intake-substances.chat',compact('intake_subs','client','client_table','weight','height','id','package'))->with('no', 1);

        }else{

            $intake_subs = Diet::exists();

            if ($intake_subs) {

                $intake_subs = Diet::leftJoin('intake_substance_images','intake_substance_images.intake_substance_id','intake_substances.id')->where('intake_substances.id',$id)->first();
            }

            $client = Client::find($intake_subs->client_id);

            $client_table = ClientTable::select('calories','carbs','protein','fat')->where('client_id',$intake_subs->client_id)->first();

            $package = Package::where('id',$client->package_id)->value('name');

            $weight = DB::table('client_answers')->where('client_id',$intake_subs->client_id)->where('question_id',9)->value('answer');

            $height = DB::table('client_answers')->where('client_id',$intake_subs->client_id)->where('question_id',10)->value('answer');

            $comments = DB::table('intake_substance_comments')->orderBy('created_at')->where('intake_subs_id', $id)->get();

            if (count($comments) > 0) {
                foreach ($comments as $comment_key => $comment) {
                    if ($comment->flag == 'nutri_client') {
                        $user_name = DB::table('users')->where('id',$comment->client_id)->value('name');
                        $comment_by_user = false;
                    }else{
                        $user_name = DB::table('clients')->where('id',$comment->client_id)->value('firstname').' '.DB::table('clients')->where('id',$comment->client_id)->value('lastname');
                        $comment_by_user = true;
                    }
                    $comments[$comment_key]->name = $user_name;
                    $comments[$comment_key]->comment_by_user = $comment_by_user;
                }
                $intake_subs['comments'] = $comments;
            }else{
                $intake_subs['comments'] = '';
            }         

            return view('backend.admin.intake-substances.chat',compact('intake_subs','client','client_table','weight','height','id','package'))->with('no', 1);      

            // return view('backend.admin.intake-substances.view_comments',compact('intake_subs'))->with('no', 1);
        }
    }


    public function viewDiet($id)
    {
        $intake_subs = Diet::exists();

        if ($intake_subs) {

            $intake_subs = Diet::leftJoin('intake_substance_images','intake_substance_images.intake_substance_id','intake_substances.id')->where('intake_substances.id',$id)->first();
        }


        $images = DB::table('intake_substance_images')->orderBy('created_at')->where('intake_substance_id', $id)->get();

        if (count($images) > 0) {
            $intake_subs['images'] = $images;
        }else{
            $intake_subs['images'] = '';
        }                


        return view('backend.admin.intake-substances.view_diet',compact('intake_subs'))->with('no', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
