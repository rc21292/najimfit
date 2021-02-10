<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientTable;
use App\Models\Package;
use App\Models\AdminRequest;
use App\Models\Note;
use Auth;
use DB;
use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Session;
use URL;
putenv('GOOGLE_APPLICATION_CREDENTIALS='.__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $clients = Client::join('nutritionist_clients','nutritionist_clients.client_id','clients.id')->where('nutritionist_id',$user->id)->get();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');
        
        $users = Client::where('id', '!=', Auth::user()->id)->take(3)->get();
        $chat = ''; 
        $receptorUser = '';


        ini_set('max_execution_time', 300); 
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.*','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id','users.id as user_id')
        ->latest('clients.created_at')
    // ->where('nutritionist_clients.table_status','due')
        ->where('nutritionist_clients.nutritionist_id',$user->id)->get();

        foreach ($clients as $key => $client) {
            $clients[$key]->is_requested = '';
            $is_exists = AdminRequest::where('client_id',$client->client_id)->exists();
            if ($is_exists) {
                $request_data = AdminRequest::where('client_id',$client->client_id)->latest()->first();
                $clients[$key]->is_requested = date('d-m-Y h:i:s A',strtotime($request_data->created_at));
            }

            $exist_requests = DB::table('requests')
                ->where('client_id', $client->client_id)
                ->exists();
                $exist_complaints = DB::table('complaints')
                ->where('client_id', $client->client_id)
                ->exists();
                if ($exist_requests) {
                    $clients[$key]->is_deferd = 1;
                }else{
                    $clients[$key]->is_deferd = 0;
                }

                 if ($exist_complaints) {
                    $clients[$key]->is_complaint = 1;
                }else{
                    $clients[$key]->is_complaint = 0;
                }

            $client_lables = DB::table('client_labels')
                         ->select(DB::raw('group_concat(DISTINCT  label) as lables'))
                         ->where('client_id', $client->client_id)
                         ->groupBy('client_id')
                         ->first();
             $clients[$key]->lables = @$client_lables->lables;

            $client_data = Client::find($client->client_id);
            $user_data = User::find($client->user_id);
            $clients[$key]->is_client_blocked = 0;
            $clients[$key]->is_nutri_blocked = 0;
            $clients[$key]->chat_status = "";
            if ($client_data->is_blocked) {
                $clients[$key]->is_client_blocked = 1;
                 $clients[$key]->chat_status = 'Client Blocked';
            }
            if ($user_data->is_blocked && $client_data->nutri_blocked) {
                $clients[$key]->is_nutri_blocked = 1;
                 $clients[$key]->chat_status = 'Nutritionist Blocked';
            }

            if (($client_data->is_blocked) && ($user_data->is_blocked && $client_data->nutri_blocked)) {
                $clients[$key]->chat_status = 'Client & Nutritionist Blocked';
            }
        }


        if($role_name == 'Nutritionist'){

             Session::forget('back_complaints_url');
            Session::put('back_complaints_url', URL::current());
            
            Session::forget('back_request_url');
            Session::put('back_request_url', URL::current());

            Session::forget('back_lables_url');
            Session::put('back_lables_url', URL::current());

             Session::forget('back_chat_url');
            Session::put('back_chat_url', URL::previous());


            return view('backend.admin.chat.index', compact('receptorUser', 'chat', 'users','clients'))->with('no',1);

        }else{
            return view('backend.admin.chat.index', compact('client','client_table','weight','height','receptorUser', 'chat', 'users','package'));
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
        $receptor = Client::where('id',$request->receiver_id)->first();

        $user = User::find(Auth::user()->id);

        if ($user->is_blocked && $receptor->nutri_blocked) {
            return response(['data' => '']);
        }

        $this->validate($request, [
            'content' => 'required',
        ]);

        $input = $request->all();
        $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

        $database = $factory->createDatabase();

        $createPost    =   $database->getReference('chats')->getvalue(); 
        $last_key =  @end(array_keys($createPost))+1;

        $ref = 'chats/'.$last_key;  

        $input['id'] = $last_key;
        $input['message_from'] = 'nutri';
        $input['is_read'] = 0;
        $input['from_admin'] = 0;
        $input['sender_id'] = Auth::user()->id;
        $input['sender_name'] = Auth::user()->name;
        $input['receiver_name'] = $receptor->firstname.' '.$receptor->lastname;
        $input['sender_image'] = Auth::user()->avatar;
        if ($receptor->avater) {
            $input['receiver_image'] = $receptor->avater;
        }else{
            $input['receiver_image'] = 'avatar.png';
        }
        $input['sender_receiver'] = Auth::user()->id.'_'.$input['receiver_id'];
        $input['timestamp'] = NOW();
        $input['created_on'] = Carbon::now()->timestamp;
        $set = $database->getReference($ref)->update($input);

        return response(['data' => $set->getvalue()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showChat($id)
    {
        $client_id = DB::table('complaints')->where('id',$id)->value('client_id');
        $nutritionist_id = DB::table('complaints')->where('id',$id)->value('nutritionist_id');

        $user = User::find($nutritionist_id);
        $client = Client::find($client_id);

        $client_table = ClientTable::select('calories','carbs','protein','fat')->where('client_id',$client_id)->first();

        if (isset($client->package_id) && !empty($client->package_id)) {
            $package = Package::where('id',$client->package_id)->value('name');
        }else{
            $package = '';
        }


        $weight = DB::table('client_answers')->where('client_id',$client_id)->where('question_id',9)->value('answer');

        $height = DB::table('client_answers')->where('client_id',$client_id)->where('question_id',10)->value('answer');

        $receptorUser = Client::where('id', '=', $client_id)->first();
        $senderUser = User::where('id', '=', $nutritionist_id)->first();
        $chat = $client_id; 
        return view('backend.admin.chat.view_chat', compact('client','client_table','weight','height','receptorUser','senderUser', 'chat','package'));

    }

    public function viewChat($id)
    {
        $client_id = DB::table('requests')->where('id',$id)->value('client_id');
        $nutritionist_id = DB::table('requests')->where('id',$id)->value('nutritionist_id');

        $user = User::find($nutritionist_id);
        $client = Client::find($client_id);

        $client_table = ClientTable::select('calories','carbs','protein','fat')->where('client_id',$client_id)->first();

        $package = Package::where('id',$client->package_id)->value('name');

        $weight = DB::table('client_answers')->where('client_id',$client_id)->where('question_id',9)->value('answer');

        $height = DB::table('client_answers')->where('client_id',$client_id)->where('question_id',10)->value('answer');

        $receptorUser = Client::where('id', '=', $client_id)->first();
        $senderUser = User::where('id', '=', $nutritionist_id)->first();
        $chat = $client_id; 
        return view('backend.admin.chat.view_chat', compact('client','client_table','weight','height','receptorUser','senderUser', 'chat','package'));

    }

    public function show($id)
    {
        $user = Auth::User();
        $clients = Client::join('nutritionist_clients','nutritionist_clients.client_id','clients.id')->where('clients.id', '!=' , $id)->where('nutritionist_id',$user->id)->get();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        $client = Client::find($id);

        $client_table = ClientTable::select('calories','carbs','protein','fat')->where('client_id',$id)->first();

        $package = Package::where('id',$client->package_id)->value('name');

        $weight = DB::table('client_answers')->where('client_id',$id)->where('question_id',9)->value('answer');

        $height = DB::table('client_answers')->where('client_id',$id)->where('question_id',10)->value('answer');

        $receptorUser = Client::where('id', '=', $id)->first();
        $users = Client::where('id', '!=', Auth::user()->id)->take(3)->get();
        $chat = $id; 

        if($role_name == 'Nutritionist'){

            Session::forget('back_chat_url');
            Session::put('back_chat_url', URL::previous());

            return view('backend.admin.chat.nut_chat', compact('client','client_table','weight','height','receptorUser', 'chat', 'users','package','clients'));

        }else{
            return view('backend.admin.chat', compact('client','client_table','weight','height','receptorUser', 'chat', 'users','package'));
        }

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
