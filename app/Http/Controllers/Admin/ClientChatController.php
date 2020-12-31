<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\AdminRequest;
use App\Models\Note;
use DB;
use Carbon\Carbon;
use Session;
use Auth;
use App\Models\ClientTable;
use App\Models\Package;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use Spatie\Permission\Traits\HasRoles;

class ClientChatController extends Controller
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

        if($role_name == 'Nutritionist'){

            return redirect()->route('client_chats.index',Auth::User()->id);

        }else{
            DB::enableQueryLog();
            $total_clients = Client::count();
            $users = User::role('Nutritionist')
            ->join('nutritionist_clients','nutritionist_clients.nutritionist_id','=','users.id')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->select('users.name','users.id','users.created_at', DB::raw("COUNT(clients.id) as clients_count"))->groupBy("nutritionist_clients.nutritionist_id",'users.name','users.id','users.created_at')
            // ->where('table_status','due')
            ->get();
            $queries = DB::getQueryLog();
            // dd(end($queries));

            foreach ($users as $key => $user) {
                $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

                $database = $factory->createDatabase();

                $createPosts    =   $database->getReference('chats')->orderByChild('is_read')->equalTo(0)->getSnapshot()->getValue();
                $count = 0;
                foreach ($createPosts as $createPost) {
                    if ($createPost["receiver_id"] == $user->id) {
                        $count++;
                    }
                }

                $users[$key]['chats_count'] = $count;
            }

            $total_chat_count = count($createPosts);

            return view('backend.admin.client_chats.index',compact('total_chat_count','users','total_clients'));
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

    public function blockClient($id)
    {
        Client::where('id',$id)->update(['is_blocked'=>1]);
        return redirect()->back()->with('success', 'Successfully Blocked Client from speaking!');
    }

    public function blockNutritionist($id)
    {
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->select('users.*')
        ->where('nutritionist_clients.client_id',$id)
        ->first();
        User::where('id',$clients->id)->update(['is_blocked'=>1]);
        Client::where('id',$id)->update(['is_blocked'=>1,'nutri_blocked'=>1]);
        return redirect()->back()->with('success', 'Successfully blocked Nutritionist from replying!');
    }

    public function store(Request $request)
    {

        $receptor = Client::where('id',$request->receiver_id)->first();
        $sender = User::where('id',$request->sender_id)->first();
        if ($sender->is_blocked && $receptor->nutri_blocked) {
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
        $input['sender_id'] = $sender->id;
        $input['sender_name'] = $sender->name;
        $input['receiver_name'] = $receptor->firstname.' '.$receptor->lastname;
        $input['sender_image'] = $sender->avatar;
        if ($receptor->avater) {
            $input['receiver_image'] = $receptor->avater;
        }else{
            $input['receiver_image'] = 'avatar.png';
        }
        $input['sender_receiver'] = $sender->id.'_'.$input['receiver_id'];
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

    public function allclients(){
        ini_set('max_execution_time', 300); 
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.*','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id','users.id as user_id')
        // ->where('nutritionist_clients.table_status','due')
        ->get();

        foreach ($clients as $key => $client) {
             $client->client_id;
            $clients[$key]->is_requested = '';
             $is_exists = AdminRequest::where('client_id',$client->client_id)->exists();
             if ($is_exists) {
                 $request_data = AdminRequest::where('client_id',$client->client_id)->latest()->first();
                 $clients[$key]->is_requested = date('d-m-Y h:i:s A',strtotime($request_data->created_at));
             }
        }
        // echo "<pre>";print_r($clients);"</pre>";exit;

        /*foreach ($clients as $key => $user) {
            
            $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

            $clients[$key]->timestamp = '';
            $database = $factory->createDatabase();

            $createPosts = $database->getReference('chats')->orderByChild('sender_receiver')->equalTo((string)$user->client_id.'_'.$user->user_id)->getSnapshot()->getValue();
            if (count($createPosts) == 0) {
                continue;
            }

            $keys = array_keys(array_combine(array_keys($createPosts), array_column($createPosts, 'is_read')),0);

            $createPostse = $database->getReference('chats')->orderByChild('id')->equalTo((string)$keys[0])->getSnapshot()->getValue();


            if (count($createPostse) > 0) {
                    $clients[$key]->timestamp = date("d-m-Y h:i:sa", array_values($createPostse)[0]["timestamp"]);
            }

        }*/


        $user_ids = [];

        // echo "<pre>";print_r($clients);"</pre>";exit;

      /*  foreach ($clients as $key => $user) {
            
            $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

            $database = $factory->createDatabase();

            $createPosts    =   $database->getReference('chats')->orderByChild('receiver_id')->equalTo((string)$user->user_id)->getSnapshot()->getValue();
            $count = 0;
            $clients[$key]->timestamp = '';
            if (count($createPosts) > 0) {
                if (array_values($createPosts)[0]["sender_id"] == $user->client_id) {
                    $clients[$key]->timestamp = array_values($createPosts)[0]["timestamp"];
                }
            }

        }

        if (!in_array($user->id, $user_ids)) {
                        array_push($user_ids, $user->id);
                        $clients[$key]->time_stamp = $createPost["timestamp"];
                    }*/
                    

        // echo "<pre>";print_r($clients);"</pre>";exit;


        return view('backend.admin.client_chats.client',compact('clients'))->with('no', 1);
    }

    public function show($id)
    {
        $client_id = $id;

        $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$id)->value('nutritionist_id');

        $user = User::find($nutritionist_id);
        $client = Client::find($client_id);

        $client_table = ClientTable::select('calories','carbs','protein','fat')->where('client_id',$client_id)->first();

        $package = Package::where('id',$client->package_id)->value('name');
        $notes = Note::where('client_id',$client_id)->latest()->get();

        $weight = DB::table('client_answers')->where('client_id',$client_id)->where('question_id',9)->value('answer');

        $height = DB::table('client_answers')->where('client_id',$client_id)->where('question_id',10)->value('answer');

        $receptorUser = Client::where('id', '=', $client_id)->first();
        $senderUser = User::where('id', '=', $nutritionist_id)->first();
        $chat = $client_id; 
        return view('backend.admin.client_chats.view_chat', compact('client','client_table','weight','height','receptorUser','senderUser','notes', 'chat','package'));
    }

    public function showClients($id)
    {
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.name','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id','users.id as user_id')
        ->where('nutritionist_clients.nutritionist_id',$id)
        // ->where('nutritionist_clients.table_status','due')
        ->get();

        foreach ($clients as $key => $user) {
             $clients[$key]->is_requested = '';

             $is_exists = AdminRequest::where('client_id',$client->client_id)->exists();
             if ($is_exists) {
                 $request_data = AdminRequest::where('client_id',$client->client_id)->latest()->first();
                 $clients[$key]->is_requested = date('d-m-Y h:i:s A',strtotime($request_data->created_at));
             }
            
            $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

            $clients[$key]->timestamp = '';
            $database = $factory->createDatabase();

            $createPosts = $database->getReference('chats')->orderByChild('sender_receiver')->equalTo((string)$user->client_id.'_'.$user->user_id)->getSnapshot()->getValue();
            if (count($createPosts) == 0) {
                continue;
            }

            $keys = array_keys(array_combine(array_keys($createPosts), array_column($createPosts, 'is_read')),0);

            $createPostse = $database->getReference('chats')->orderByChild('id')->equalTo((string)$keys[0])->getSnapshot()->getValue();


            if (count($createPostse) > 0) {
                    $clients[$key]->timestamp = date("d-m-Y h:i:sa", array_values($createPostse)[0]["timestamp"]);
            }

        }

        return view('backend.admin.client_chats.client',compact('clients'))->with('no', 1);
    }

    public function deferClient($id)
    {
        $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$id)->value('nutritionist_id');
        $client_name = DB::table('clients')->where('id',$id)->value('firstname').' '.DB::table('clients')->where('id',$id)->value('lastname');
        $nutritionist_name = User::where('id',$nutritionist_id)->value('name');
        $nutritionists = User::whereNotIn('id',[$nutritionist_id,'1'])->get();
        $client_id = $id;
        return view('backend.admin.client_chats.defer_client',compact('id','nutritionists','nutritionist_name','client_name','client_id'));
    }

    public function markUnread($id)
    {
        $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

        $database = $factory->createDatabase();

        $createPosts    =   $database->getReference('chats')->orderByChild('sender_id')->equalTo((int)$id)->getSnapshot()->getValue();

        foreach ($createPosts as $key => $createPost) {

            $ref = 'chats/' . $createPost["id"];  

            $updates = [
                'is_read' => 0,
            ];

            $set = $database->getReference($ref)->update($updates);
        }

         return redirect()->back()->with('success', 'messages updated to unread!');   
    }


    public function assignToNutritionist(Request $request)
    {
        DB::table('nutritionist_clients')->where('client_id',$request->client_id)->update(['nutritionist_id'=>$request->nutritionist]);
        return redirect()->route('client-chats.index')->with('success','Client Assigned to Nutritionist successfully');
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
