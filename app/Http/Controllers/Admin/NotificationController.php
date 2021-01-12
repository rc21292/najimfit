<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\DeferRequest;
use App\Models\Complaint;
use App\Models\AdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class NotificationController extends Controller
{
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

        $clients = Client::latest()->get();

        foreach ($clients as $key => $client) 
        {
            $nutritionist_id = DB::table('nutritionist_clients')
            ->where('client_id', $client->id)
            ->value('nutritionist_id');

            $clients[$key]->is_requested = '';
            $clients[$key]->client_id = $client->id;
            $is_exists = AdminRequest::where('client_id',$client->id)->exists();
            if ($is_exists) {
                $request_data = AdminRequest::where('client_id',$client->id)->latest()->first();
                $clients[$key]->is_requested = date('d-m-Y h:i:s A',strtotime($request_data->created_at));
            }

            $client_data = Client::find($client->id);
            $user_data = User::find($nutritionist_id);
            $clients[$key]->is_client_blocked = 0;
            $clients[$key]->is_nutri_blocked = 0;
            if ($client_data->is_blocked) {
                $clients[$key]->is_client_blocked = 1;
            }
            if (@$user_data->is_blocked && $client_data->nutri_blocked) {
                $clients[$key]->is_nutri_blocked = 1;
            }
        }

        return view('backend.admin.controls.notifications.index',compact('clients'))->with('no', 1);
    }

    public function sendPushNotification(Request $request)
    {
        $clients = Client::whereNotNull('package_id')->get(); 
        return view('backend.admin.controls.notifications.notify_clients',compact('clients'))->with('no', 1);
    }        

    public function postPushNotification(Request $request)
    {

        $registrationIds = [];

        foreach ($request->client as $value) {
            $client = Client::find($value);
            if (!empty($client->device_token) || $client->device_token != '' || $client->device_token) {
                array_push($registrationIds, $client->device_token);
            }
        }
      
        define('API_ACCESS_KEY','AAAAaQ_Z6Gc:APA91bHZQUWAbnFfniSKnSk7vSzAgbeWcJzVU-4I68WxVhHKaqtrrJCDX1j73B3KCido9FMm6oTY2HNHAyhNTo0qlIosrklhowbcQYtvLIUAlzYWOCZ7udfEEjYZqjRQ_8--0d5KMYvj');

        $url = 'https://fcm.googleapis.com/fcm/send';

        $message = array( 
            'title'     => $request->message,
            'body'      => $request->message,
            'vibrate'   => 1,
            'sound'      => 1
        );

        $fields = array( 
            'registration_ids' => $registrationIds, 
            'data'             => $message
        );

        $headers = array( 
            'Authorization: key='.API_ACCESS_KEY, 
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL,$url);
        curl_setopt( $ch,CURLOPT_POST,true);
        curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
        $result = curl_exec($ch);
        $results = json_decode($result);
        curl_close($ch);

        if (empty($results)) {
           return redirect()->back()->with('error', 'Unable to Notificatify Clients!');
        }

        if ($results->failure == 0) {
            return redirect()->back()->with('success', 'Client Notificatified successfully!');
        }else{
            return redirect()->back()->with('error', 'Unable to Notificatify Clients!');
        }

    }

    public function sendInChatBroadcast(Request $request)
    {

    }
    public function notificationsHistory(Request $request)
    {

    }
    public function broadcastsHistory(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.controls.notifications.index');
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
        //
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
