<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientTable;
use App\Models\Package;
use Auth;
use DB;
use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
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

        if($role_name == 'Nutritionist'){

            return view('backend.admin.chat.index', compact('receptorUser', 'chat', 'users','clients'));

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

        $package = Package::where('id',$client->package_id)->value('name');

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
