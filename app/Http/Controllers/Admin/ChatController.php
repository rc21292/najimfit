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
use Google\Cloud\Firestore\FirestoreClient;
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
        $db = new FirestoreClient([
            'projectId' => 'test-tegdarco',
        ]);

        /*$citiesRef = $db->collection('users');
        $citiesRef->document('er.krishna.mishra@gmail.com')->set([
            'id' => 'er.krishna.mishra@gmail.com',
            'chattingWith' => 'laxman@gmail.com',
            'photoUrl' => 'https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg',
            'nickname' => 'Krishna Mishra',
            'createdAt' => '1606289391323'
        ]);*/

        $userRef =  $db->collection('users');
        $documents = $userRef->documents();
/*$documents =  $db->collection('messages/er.krishna.mishra@gmail.com-fire1test@gmail.com/er.krishna.mishra@gmail.com-fire1test@gmail.com')->documents();*/
            // echo "<pre>";print_r($documents);"</pre>";exit;
        foreach ($documents as $document) {
            if ($document->exists()) {
                printf('Document data for document %s:' . PHP_EOL, $document->id());
                print_r($document->data());
                printf(PHP_EOL);
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }

        echo "<pre>";print_r('kkk');"</pre>";exit;
        die;


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

        $receptor = Client::where('id',$request->receptor_id)->first();

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
        $input['user_id'] = Auth::user()->id;
        $input['user_name'] = Auth::user()->name;
        $input['receptor_name'] = $receptor->firstname.' '.$receptor->lastname;
        $input['user_iamge'] = Auth::user()->avatar;
        if ($receptor->avater) {
            $input['receptor_image'] = $receptor->avater;
        }else{
            $input['receptor_image'] = 'avatar.png';
        }
        $input['sender_reseptent'] = Auth::user()->id.'_'.$input['receptor_id'];
        $input['timestamp'] = NOW();
        $set = $database->getReference($ref)->update($input);

        return response(['data' => $set->getvalue()], 200);
        $db = new FirestoreClient([
            'projectId' => 'test-tegdarco',
        ]);

        $citiesRef = $db->collection('users');
        $citiesRef->document('er.krishna.mishra@gmail.com')->set([
            'id' => 'er.krishna.mishra@gmail.com',
            'chattingWith' => 'laxman@gmail.com',
            'photoUrl' => 'https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg',
            'nickname' => 'Krishna Mishra',
            'createdAt' => '1606289391323'
        ]);
        
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
        $user = Auth::User();
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

            return view('backend.admin.nut_chat', compact('client','client_table','weight','height','receptorUser', 'chat', 'users','package'));

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
