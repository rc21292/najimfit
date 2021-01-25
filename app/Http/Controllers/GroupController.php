<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Group;
use DB;
use App\Conversation;
use Illuminate\Http\Request;
use Cookie;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $groups = auth()->user()->groups;

        $users = User::where('id', '<>', auth()->user()->id)->get();
        $user = auth()->user();

        return $users;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $group = Group::create(['name' => request('name'),'admin_id' =>auth()->user()->id]);

        $addedusers = collect(request('users'));
        $addedusers->push(auth()->user()->id);

        $group->users()->attach($addedusers);

        $groups = auth()->user()->groups;

        $users = User::where('id', '<>', auth()->user()->id)->get();
        $user = auth()->user();

        return view('backend.admin.chat.new_groupchat', ['groups' => $groups, 'users' => $users, 'user' => $user]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $lifetime = time() + 60 * 60 * 24 * 365; 

        Cookie::queue('group_chat_id', $id, $lifetime);

        $groups = auth()->user()->groups;

        $users = User::where('id', '<>', auth()->user()->id)->get();
        $user = auth()->user();

        $conversations = Conversation::where('group_id',$id)->with('User')->orderBy('id','asc')->take(100)->get();

        $count = Conversation::where('group_id',$id)->count();
        $group_name = Group::where('id',$id)->value('name');
        $participants = DB::table('group_user')->join('users','users.id','=','group_user.user_id')->select('users.*')->where('group_user.group_id',$id)->get();
        
        return view('backend.admin.chat.new_groupchat', ['groups' => $groups, 'users' => $users, 'user' => $user,'conversations' => $conversations,'group_id'=>$id,'count'=> $count, 'group_name'=>$group_name,'participants'=>$participants]);
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
