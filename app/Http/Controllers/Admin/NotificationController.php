<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\DeferRequest;
use App\Models\Complaint;
use App\Models\AdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class NotificationController extends Controller
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

        $clients = Client::latest()->get();

        foreach ($clients as $key => $client) 
        {
            $nutritionist_id = DB::table('nutritionist_clients')
            ->where('client_id', $client->id)
            ->value('nutritionist_id');

            $clients[$key]->is_requested = '';
            $clients[$key]->client_id = $client->id;
            $is_exists = AdminRequest::where('client_id',$client->id)->exists();
            if ($is_exists) {
                $request_data = AdminRequest::where('client_id',$client->id)->latest()->first();
                $clients[$key]->is_requested = date('d-m-Y h:i:s A',strtotime($request_data->created_at));
            }

            $client_data = Client::find($client->id);
            $user_data = User::find($nutritionist_id);
            $clients[$key]->is_client_blocked = 0;
            $clients[$key]->is_nutri_blocked = 0;
            if ($client_data->is_blocked) {
                $clients[$key]->is_client_blocked = 1;
            }
            if (@$user_data->is_blocked && $client_data->nutri_blocked) {
                $clients[$key]->is_nutri_blocked = 1;
            }
        }

        return view('backend.admin.controls.notifications.index',compact('clients'))->with('no', 1);
    }


    public function sendPushNotification(Request $request)
    {

    }
    public function sendInChatBroadcast(Request $request)
    {

    }
    public function notificationsHistory(Request $request)
    {

    }
    public function broadcastsHistory(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.controls.notifications.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
