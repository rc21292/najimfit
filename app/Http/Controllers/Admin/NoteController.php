<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Note;
use App\Models\Client;
use Auth;
use Session;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:notes']);
    }
    
    public function index()
    {
        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist')
        {
            $requests = Note::where('nutritionist_id',$user->id)->latest()->get();

            Note::where('nutritionist_id',$user->id)->update(['status' => 1]);

            return view('backend.admin.notes.nutritionist.index',compact('requests'))->with('no', 1);
        }else{
            $requests = Note::latest()->get();
            return view('backend.admin.notes.index',compact('requests'))->with('no', 1);
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

    public function sendNote($id)
    {
        return view('backend.admin.notes.create',compact('id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$input['client_id'])->value('nutritionist_id');
        $user = User::find($nutritionist_id);
        $client = Client::where('id',$input['client_id'])->first();
        $input['nutritionist_id'] = $nutritionist_id;
        $input['nutritionist_name'] = $user->name;
        $input['client_name'] = $client->firstname.' '.$client->lastname;

        $user = Note::create($input);
        
        return redirect()->to(Session::get('back_notes_url'))->with('success','Note Created successfully');
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
