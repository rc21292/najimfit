<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use Auth;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Session;

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
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $receiver = User::select('id','name','avater')->where('id',$request->receiver_id)->first();
        $input = $request->all();
        $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

        $database = $factory->createDatabase();

        $createPost    =   $database->getReference('chats')->getvalue(); 
        $last_key =  @end(array_keys($createPost))+1;

        $ref = 'chats/'.$last_key;  

        $input['id'] = $last_key;
        $input['message_from'] = 'user';
        $input['sender_id'] = Auth::user()->id;
        $input['sender_name'] = Auth::user()->firstname.' '.Auth::user()->lastname;
        $input['sender_image'] = Auth::user()->avatar;
        $input['receiver_name'] = $receiver->name;
        if ($receiver->avater) {
            $input['receiver_image'] = $receiver->avater;
        }else{
            $input['receiver_image'] = 'avatar.png';
        }
        $input['sender_receiver'] = $input['receiver_id'].'_'.Auth::user()->id;
        $input['is_read'] = 0;
        $input['timestamp'] = NOW();
        $set = $database->getReference($ref)->update($input);
        $chat_data = $set->getvalue();

        if ($chat_data['message_from'] == 'user') {                
            $chat_data["sender_image"] = 'https://tegdarco.com/uploads/clients/images/'.@$chat_data['sender_image'];
            $chat_data["receiver_image"] = 'https://tegdarco.com/uploads/user/'.@$chat_data['receiver_image'];
        }
        else{
            $chat_data["sender_image"] = 'https://tegdarco.com/uploads/user/'.@$chat_data['sender_image'];
            $chat_data["receiver_image"] = 'https://tegdarco.com/uploads/clients/images/'.@$chat_data['receiver_image'];
        }

        return response(['success' => true,'message'=> 'data inserted successfully','data' => $chat_data], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function getChat(Request $request)
    {
        $factory = (new Factory)->withServiceAccount(__DIR__.'/test-tegdarco-firebase-adminsdk-ohk7s-6c3ea5636a.json');

        $database = $factory->createDatabase();
        $sender_reseptent = $request->receiver_id.'_'.Auth::user()->id;

        $createPost    =   $database->getReference('chats')->orderByChild('sender_receiver')->equalTo($sender_reseptent)->getSnapshot()->getValue();

        $chat_data = array_values($createPost);

        usort($chat_data, function ($a, $b) { return ($this->intcmp( @$b["id"], @$a["id"])); });

        foreach ($chat_data as $key => $value) {
            if ($value['message_from'] == 'user') {                
                $chat_data[$key]["sender_image"] = 'https://tegdarco.com/uploads/clients/images/'.@$value['sender_image'];
                $chat_data[$key]["receiver_image"] = 'https://tegdarco.com/uploads/user/'.@$value['receiver_image'];
            }
            else{
                $chat_data[$key]["sender_image"] = 'https://tegdarco.com/uploads/user/'.@$value['sender_image'];
                $chat_data[$key]["receiver_image"] = 'https://tegdarco.com/uploads/clients/images/'.@$value['receiver_image'];
            }
        }

        if (count($chat_data) > 0) {
            return $response = ['success' => true,'message' => 'Data fetched successfully','data' => $chat_data];
        }else{
            return $response = ['success' => false,'message' => 'no chat'];
        }
    }

    function intcmp($a,$b)
    {
        return ($a-$b) ? ($a-$b)/abs($a-$b) : 0;
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
