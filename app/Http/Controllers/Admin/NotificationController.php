<?php
namespace App\Http\Controllers\Admin;
define('API_ACCESS_KEY','AAAAaQ_Z6Gc:APA91bHZQUWAbnFfniSKnSk7vSzAgbeWcJzVU-4I68WxVhHKaqtrrJCDX1j73B3KCido9FMm6oTY2HNHAyhNTo0qlIosrklhowbcQYtvLIUAlzYWOCZ7udfEEjYZqjRQ_8--0d5KMYvj');

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\DeferRequest;
use App\Models\Complaint;
use App\Models\AdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Auth;
use Spatie\Permission\Traits\HasRoles;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

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
        return view('backend.admin.controls.notifications.general.notify_clients',compact('clients'))->with('no', 1);
    } 

    public function sendPersonalizedPushNotification(Request $request)
    {
        $clients = Client::whereNotNull('package_id')->get(); 
        return view('backend.admin.controls.notifications.personalized.notify_clients',compact('clients'))->with('no', 1);
    }         

    public function postGeneralPushNotification(Request $request)
    {
        $registrationIds = [];

        $clients = array();

        foreach ($request->labels as $key => $label) {
            
        $client_ids = DB::table('client_labels')->where('label',$label)->pluck('client_id');
        foreach ($client_ids as $client_id) {
            if (!in_array($client_id, $clients)) {
            array_push($clients, $client_id);
            }
        }
        }
        foreach ($clients as $value) {
            $client = Client::find($value);
            if (!empty($client->device_token) || $client->device_token != '' || $client->device_token) {
                $message = $request->message;
                DB::table('notification_histories')->insert(
                    ['client_id' => $value,'message_type' => 'General', 'message' => $message]
                );
                $result = $this->sendFcmMessage($client->device_token,str_replace('{client_name}', $client->firstname.' '.$client->lastname, $message));
            }else{
                DB::table('notification_histories')->insert(
                    ['client_id' => $value,'message_type' => 'General', 'status' => 0, 'message' => $request->message]
                );
                $result = false;
            }
        }
            


        if ($result) {
            return redirect()->back()->with('success', 'Clients Notificatified successfully!');
        }else{
            return redirect()->back()->with('warning', 'Unable to Notificatify Clients!');
        }

    }

    public function postPushNotification(Request $request)
    {
        $registrationIds = [];

        foreach ($request->client as $value) {
            $client = Client::find($value);
            $message = str_replace('{client_name}', $client->firstname.' '.$client->lastname, $request->message);
            if (!empty($client->device_token) || $client->device_token != '' || $client->device_token) {
                DB::table('notification_histories')->insert(
                    ['client_id' => $value,'message_type' => 'Personalized', 'message' => $message]
                );
                $result = $this->sendFcmMessage($client->device_token,$message);
            }else{
                DB::table('notification_histories')->insert(
                    ['client_id' => $value,'message_type' => 'Personalized', 'status' => 0, 'message' => $request->message]
                );
            }
        }         

        if ($result) {
            return redirect()->back()->with('success', 'Clients Notificatified successfully!');
        }else{
            return redirect()->back()->with('warning', 'Unable to Notificatify Clients!');
        }

    }

    public function sendInchatMessage($receiver_id,$sender_id,$message)
    {
         $receptor = Client::where('id',$receiver_id)->first();
        $sender = User::where('id',$sender_id)->first();
     /*   if ($sender->is_blocked && $receptor->nutri_blocked) {
            return response(['data' => '']);
        }*/

        $input = array();
        $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

        $database = $factory->createDatabase();

        $createPost    =   $database->getReference('chats')->getvalue(); 
        $last_key =  @end(array_keys($createPost))+1;

        $ref = 'chats/'.$last_key;  

        $input['id'] = $last_key;
        $input['content'] = $message;
        $input['message_from'] = 'nutri';
        $input['is_read'] = 0;
        $input['from_admin'] = 1;
        $input['sender_id'] = $sender->id;
        $input['sender_name'] = $sender->name;
        $input['receiver_id'] = $receiver_id;
        $input['receiver_name'] = $receptor->firstname.' '.$receptor->lastname;
        $input['sender_image'] = $sender->avatar;
        if ($receptor->avater) {
            $input['receiver_image'] = $receptor->avater;
        }else{
            $input['receiver_image'] = 'avatar.png';
        }
        $input['sender_receiver'] = $sender->id.'_'.$receiver_id;
        $input['timestamp'] = NOW();
        $input['created_on'] = Carbon::now()->timestamp;
        $set = $database->getReference($ref)->update($input);
        return true;

        return response(['data' => $set->getvalue()], 200);
    }

    public function postBroadcastGeneralPushNotification(Request $request)
    {
        $registrationIds = [];

        $clients = array();

        foreach ($request->labels as $key => $label) {
            
        $client_ids = DB::table('client_labels')->where('label',$label)->pluck('client_id');
        foreach ($client_ids as $client_id) {
            if (!in_array($client_id, $clients)) {
            array_push($clients, $client_id);
            }
        }
        }
        foreach ($clients as $value) {
            $client = Client::find($value);
            $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$value)->value('nutritionist_id');
                $message = $request->message;
                DB::table('broadcast_histories')->insert(
                    ['client_id' => $value,'message_type' => 'General', 'message' => $message]
                );
                $result = $this->sendInchatMessage($value,$nutritionist_id,$message);
        }
            


        if ($result) {
            return redirect()->back()->with('success', 'Clients Notificatified successfully!');
        }else{
            return redirect()->back()->with('warning', 'Unable to Notificatify Clients!');
        }

    }

    public function postBroadcastPushNotification(Request $request)
    {
        $registrationIds = [];

        foreach ($request->client as $value) {
            $client = Client::find($value);
            $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$client->id)->value('nutritionist_id');
            if (!$nutritionist_id) {
                return redirect()->back()->with('success', 'Clients Not Assigneed to any nutritionist!');
            }
                $message = str_replace('{client_name}', $client->firstname.' '.$client->lastname, $request->message);
                DB::table('broadcast_histories')->insert(
                    ['client_id' => $value,'message_type' => 'Broadcasts', 'message' => $message]
                );
                $result = $this->sendInchatMessage($value,$nutritionist_id,$message);
        }         

        if ($result) {
            return redirect()->back()->with('success', 'Clients Notificatified successfully!');
        }else{
            return redirect()->back()->with('warning', 'Unable to Notificatify Clients!');
        }

    }

    public function sendFcmMessage($token,$message)
    {      

        $url = 'https://fcm.googleapis.com/fcm/send';

        $message = array( 
            'title'     => $message,
            'body'      => $message,
            'vibrate'   => 1,
            'sound'      => 1
        );

        $fields = array( 
            'registration_ids' => [$token], 
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
           return false;
        }

        if ($results->failure == 0) {
            return true;
        }else{
            return false;
        }
    }

    public function sendInChatBroadcast(Request $request)
    {
        $clients = Client::latest()->get(); 
        return view('backend.admin.controls.notifications.broadcasts.general.notify_clients',compact('clients'))->with('no', 1);
    }

    public function sendPersonalizedInChatBroadcast(Request $request)
    {
        $clients = Client::latest()->get(); 
        return view('backend.admin.controls.notifications.broadcasts.personalized.notify_clients',compact('clients'))->with('no', 1);
    }

    public function notificationsHistory(Request $request)
    {
        echo "<pre>";print_r('workinng on this page');"</pre>";exit;
        $notifications_history = DB::table('notification_histories')->join('clients','clients.id','notification_histories.client_id')->select('firstname','lastname','notification_histories.*')->latest('notification_histories.created_at')->get();
        return view('backend.admin.controls.notifications.notifications_history',compact('notifications_history'))->with('no', 1);
    }

    public function broadcastsHistory(Request $request)
    {
        echo "<pre>";print_r('workinng on this page');"</pre>";exit;
        $broadcasts_history = DB::table('broadcast_histories')->join('clients','clients.id','broadcast_histories.client_id')->select('firstname','lastname','broadcast_histories.*')->latest('broadcast_histories.created_at')->get();
        return view('backend.admin.controls.notifications.broadcasts_history',compact('broadcasts_history'))->with('no', 1);
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
