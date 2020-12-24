<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Note;
use DB;
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

            return redirect()->route('assign-table.show',Auth::User()->id);

        }else{

            $total_clients = Client::count();
            $users = User::role('Nutritionist')
            ->join('nutritionist_clients','nutritionist_clients.nutritionist_id','=','users.id')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->select('users.name','users.id','users.created_at', DB::raw("COUNT(clients.id) as clients_count"))->groupBy("nutritionist_clients.nutritionist_id",'users.name','users.id','users.created_at')->where('table_status','due')
            ->get();

            return view('backend.admin.client_chats.index',compact('users','total_clients'));
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
        $sender = User::where('id',$request->sender_id)->first();

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
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.*','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        ->where('nutritionist_clients.table_status','due')
        ->get();
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
        ->select('clients.*','users.name','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        ->where('nutritionist_clients.nutritionist_id',$id)->where('nutritionist_clients.table_status','due')
        ->get();

        return view('backend.admin.client_chats.client',compact('clients'))->with('no', 1);
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
