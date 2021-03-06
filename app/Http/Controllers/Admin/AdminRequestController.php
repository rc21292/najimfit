<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\AdminRequest;
use App\Models\User;
use App\Models\Client;
use Auth;

class AdminRequestController extends Controller
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
            $requests = AdminRequest::where('nutritionist_id',$user->id)->get();
            AdminRequest::where('nutritionist_id',$user->id)->update(['status' => 1]);

            return view('backend.admin.admin_requests.nutritionist.index',compact('requests'))->with('no', 1);
        }else{
            $requests = AdminRequest::where('status',0)->get();
            return view('backend.admin.admin_requests.index',compact('requests'))->with('no', 1);
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
    public function store($id)
    {
        $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$id)->value('nutritionist_id');
        $user = User::find($nutritionist_id);
        $client = Client::where('id',$id)->first();
        $input['nutritionist_id'] = $nutritionist_id;
        $input['nutritionist_name'] = $user->name;
        $input['client_id'] = $id;
        $input['reason'] = 'Request to response immediately.';
        $input['client_name'] = $client->firstname.' '.$client->lastname;

        $user = AdminRequest::create($input);

        return redirect()->back()->withSuccess('Request Created successfully');
        /*return redirect()->back()->with('message', 'Request Created successfully');
        return redirect()->route('admin-requests.index')->with('success','Request Created successfully');*/
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
