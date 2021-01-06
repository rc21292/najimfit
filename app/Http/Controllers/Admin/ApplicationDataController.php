<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminRequest;
use App\Models\Client;
use App\Models\Package;
use DB;
use Carbon\Carbon;
use Session;
use Auth;

class ApplicationDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $total_clients = Client::count();
        $users = User::role('Nutritionist')
        ->join('nutritionist_clients','nutritionist_clients.nutritionist_id','=','users.id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('users.name','users.id','users.created_at', DB::raw("COUNT(clients.id) as clients_count"))->groupBy("nutritionist_clients.nutritionist_id",'users.name','users.id','users.created_at')->where('table_status','due')
        ->get();

        // $packages = Package::join('clients','clients.package_id','=','packages.id')->get();

        $packages = DB::table('clients')->join('packages','packages.id','clients.package_id')
        ->select('package_id','packages.name', DB::raw('count(*) as total'))
        ->whereNotNull('package_id')
        ->groupBy('package_id')
        ->get();


        $clients_more_than_one_month = client::where('created_at', '<=', Carbon::now()->subMonth(1)->toDateTimeString())->count();

        $feedbacks = 0;

        $clients_new = client::whereMonth('created_at', Carbon::now()->month)->count();

        $table_renewals = DB::table('nutritionist_clients')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->where('table_status','posted')
        ->count();

        $workout_renewals = DB::table('nutritionist_clients')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->where('workout_status','posted')
        ->count();

        return view('backend.admin.application_data.index',compact('users','total_clients','packages','clients_more_than_one_month','clients_new','feedbacks','table_renewals','workout_renewals'));

    }

    public function allClients()
    {
        $clients = Client::latest()->get();

            foreach ($clients as $key => $client) {

                $nutritionist_id = DB::table('nutritionist_clients')
                ->where('client_id', $client->id)
                ->value('nutritionist_id');

                $nutritionist = DB::table('users')
                ->where('id', $nutritionist_id)->value('name');
                $clients[$key]->nutritionist = $nutritionist;

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

            return view('backend.admin.application_data.clients',compact('clients'))->with('no', 1);
    }

    public function newClients()
    {
        $clients = Client::select('clients.*','clients.created_at as assigned_on','clients.id as client_id')
        ->whereMonth('created_at', Carbon::now()->month)
        ->latest()->get();

        foreach ($clients as $key => $client) {

                $nutritionist_id = DB::table('nutritionist_clients')
                ->where('client_id', $client->id)
                ->value('nutritionist_id');

                $nutritionist = DB::table('users')
                ->where('id', $nutritionist_id)->value('name');
                $clients[$key]->nutritionist = $nutritionist;

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

        return view('backend.admin.application_data.new_clients',compact('clients'))->with('no', 1);

    }

    public function olderClients()
    {
        $clients = Client::select('clients.*','clients.created_at as assigned_on','clients.id as client_id')
        ->where('created_at', '<=', Carbon::now()->subMonth(1)->toDateTimeString())
        ->latest()->get();

        foreach ($clients as $key => $client) {

                $nutritionist_id = DB::table('nutritionist_clients')
                ->where('client_id', $client->id)
                ->value('nutritionist_id');

                $nutritionist = DB::table('users')
                ->where('id', $nutritionist_id)->value('name');
                $clients[$key]->nutritionist = $nutritionist;

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

        return view('backend.admin.application_data.older_clients',compact('clients'))->with('no', 1);
    }

    public function renewWorkoutClients()
    {
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.*','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        ->where('nutritionist_clients.workout_status','posted')
        ->get();
        return view('backend.admin.application_data.renew_workout',compact('clients'))->with('no', 1);
    }

    public function clientsByPackageId($package_id)
    {
        $clients = Client::select('clients.*','clients.created_at as assigned_on','clients.id as client_id')
        ->where('clients.package_id',$package_id)
        ->latest()->get();

        foreach ($clients as $key => $client) {

                $nutritionist_id = DB::table('nutritionist_clients')
                ->where('client_id', $client->id)
                ->value('nutritionist_id');

                $nutritionist = DB::table('users')
                ->where('id', $nutritionist_id)->value('name');
                $clients[$key]->nutritionist = $nutritionist;

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

        return view('backend.admin.application_data.package_clients',compact('clients'))->with('no', 1);
    }

    public function renewTableClients($value='')
    {
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.*','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        ->where('nutritionist_clients.table_status','posted')
        ->get();
        return view('backend.admin.application_data.renew_table',compact('clients'))->with('no', 1);
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
