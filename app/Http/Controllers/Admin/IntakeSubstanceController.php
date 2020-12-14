<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Session;
use Auth;
use App\Models\Diet;
use App\Models\User;
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
        $intake_subs = Diet::exists();

        if ($intake_subs) {

            $intakeSubs = Diet::orderBy('created_at')->get()->groupBy(function($item) {
                    return $item->client_id;
                });

            // echo "<pre>";print_r($intakeSubs->toArray());"</pre>";exit;


           $intake_subs = Diet::select('intake_substances.client_id','clients.firstname','clients.lastname')->join('clients','clients.id','=','intake_substances.client_id')->distinct()->get();
           return view('backend.admin.intake-substances.index',compact('intake_subs'))->with('no', 1);
       }
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
        //
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


    public function viewDiet($id)
    {
        $intake_subs = Diet::exists();

        if ($intake_subs) {

            $intake_subs = Diet::leftJoin('intake_substance_images','intake_substance_images.intake_substance_id','intake_substances.id')->where('intake_substances.id',$id)->first();
        }


        $images = DB::table('intake_substance_images')->orderBy('created_at')->where('intake_substance_id', $id)->get();

        if ($images) {
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
