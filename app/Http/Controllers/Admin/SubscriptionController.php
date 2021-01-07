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

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $active_subscriptions = DB::table('clients')
        ->whereNotNull('package_id')
        ->count('id');

        $waiting_subscriptions = DB::table('clients')
        ->whereNull('package_id')
        ->count('id');

        DB::connection()->enableQueryLog();
        $subscriptions_by_nutritionists = DB::table('nutritionist_clients')
            ->join('clients','clients.id','nutritionist_clients.client_id')
            ->join('users','users.id','nutritionist_clients.nutritionist_id')
            ->select('nutritionist_clients.nutritionist_id','users.name', DB::raw('group_concat(client_id) as client_ids'), DB::raw('count(client_id) as total'))
            ->whereNotNull('package_id')
            ->groupBy('nutritionist_clients.nutritionist_id')
            ->get();

            $total_per_nutritionist = 0;
            foreach($subscriptions_by_nutritionists as $key => $subscriptions_by_nutritionist) {
                $total_per_nutritionist += $subscriptions_by_nutritionist->total;
            }

        $subscriptions_by_nutritionists_total = count($subscriptions_by_nutritionists);

            $average_per_nutritionist = round($total_per_nutritionist/$subscriptions_by_nutritionists_total);


        $queries = DB::getQueryLog();
        $last_query = end($queries);

        // echo "<pre>";print_r($packages);"</pre>";exit;


       /* $packages = DB::table('clients')->join('nutritionist_clients','nutritionist_clients.client_id','=','clients.id')
        ->select('nutritionist_id', DB::raw('group_concat(client_id) as client_ids'), DB::raw('count(package_id) as total'))
        ->whereNotNull('package_id')
        ->groupBy('nutritionist_id')
        ->get();

        echo "<pre>";print_r($packages);"</pre>";exit;*/


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

        return view('backend.admin.controls.subscriptions.index',compact('clients','active_subscriptions','waiting_subscriptions','subscriptions_by_nutritionists','subscriptions_by_nutritionists_total','average_per_nutritionist'))->with('no', 1);
    }

    public function AcceptSubscriptions(Request $request)
    {

    }

    public function CloseSubscriptions(Request $request)
    {

    }

    public function CancelSubscription(Request $request)
    {

    }

    public function ExtensionSubscription(Request $request)
    {

    }
    
    public function BlockSubscription(Request $request)
    {

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
