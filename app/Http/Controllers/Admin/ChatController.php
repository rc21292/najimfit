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
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'content' => 'required',
        ]);

        $input = $request->all();
        $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

        $database = $factory->createDatabase();

        $createPost    =   $database->getReference('chats')->getvalue(); 
        $last_key =  @end(array_keys($createPost))+1;

        $ref = 'chats/'.$last_key;  

        $input['ip'] = request()->ip();
        $input['type'] = 'chat';
        $input['id'] = $last_key;
        $input['user_id'] = Auth::user()->id;
        $input['sender_reseptent'] = $input['receptor_id'].'_'.Auth::user()->id;
        $input['updated_at'] = NOW();
        $input['created_at'] = NOW();
        $set = $database->getReference($ref)->update($input);

        return response(['data' => $set->getvalue()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        $client_table = ClientTable::select('calories','carbs','protein','fat')->where('client_id',$id)->first();

        $package = Package::where('id',$client->package_id)->value('name');

        $weight = DB::table('client_answers')->where('client_id',$id)->where('question_id',9)->value('answer');

        $height = DB::table('client_answers')->where('client_id',$id)->where('question_id',10)->value('answer');

        $receptorUser = Client::where('id', '=', $id)->first();
        $users = Client::where('id', '!=', Auth::user()->id)->take(3)->get();
        $chat = $id; 
        return view('backend.admin.chat', compact('client','client_table','weight','height','receptorUser', 'chat', 'users','package'));
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
