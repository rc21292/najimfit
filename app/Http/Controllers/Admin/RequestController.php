<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\DeferRequest;
use App\Models\User;
use App\Models\Client;
use Auth;

class RequestController extends Controller
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

        if($role_name == 'Nutritionist')
        {
            $requests = DeferRequest::where('nutritionist_id',$user->id)->get();
            return view('backend.admin.requests.nutritionist.index',compact('requests'))->with('no', 1);
        }else{
            $requests = DeferRequest::where('status',0)->get();
            return view('backend.admin.requests.index',compact('requests'))->with('no', 1);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('backend.admin.requests.create',compact('id'));
    }

    public function deferClient($id)
    {
        $client_id = DB::table('requests')->where('id',$id)->value('client_id');
        $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$client_id)->value('nutritionist_id');
        $client_name = DB::table('clients')->where('id',$client_id)->value('firstname').' '.DB::table('clients')->where('id',$client_id)->value('lastname');
        $nutritionist_name = User::where('id',$nutritionist_id)->value('name');
        $nutritionists = User::whereNotIn('id',[$nutritionist_id,'1'])->get();
        return view('backend.admin.requests.defer_client',compact('id','nutritionists','nutritionist_name','client_name','client_id'));
    }

    public function assignToNutritionist(Request $request)
    {
        DB::table('nutritionist_clients')->where('client_id',$request->client_id)->update(['nutritionist_id'=>$request->nutritionist]);
        DB::table('requests')->where('id',$request->id)->where('client_id',$request->client_id)->update(['status'=>1]);
        $requests = DeferRequest::all();
            return view('backend.admin.requests.index',compact('requests'))->with('no', 1);
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

        $user = DeferRequest::create($input);
        
        return redirect()->route('requests.index')->with('success','Request Created successfully');
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
