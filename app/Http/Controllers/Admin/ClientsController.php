<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\DeferRequest;
use App\Models\Complaint;
use App\Models\AdminRequest;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Session;
use URL;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware(['permission:clients']);

    }

    public function index(Request $request)
    {

        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist'){
            $clients_data = DB::table('nutritionist_clients')
            ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->select('clients.*','users.name','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
            ->where('nutritionist_clients.nutritionist_id',Auth::User()->id);

            $filter = $request->input('filter');
            if ($request->has('filter')) {
                if ($request->input('filter') == 'waiting') {
                    $clients_data->where('clients.is_subscription_in_wating',1);
                }
                if ($request->input('filter') == 'block') {
                    $clients_data->where('clients.blocked_from_app',1);
                }
                if ($request->input('filter') == 'unblock') {
                    $clients_data->where('clients.blocked_from_app',0);
                }
            }

            $clients = $clients_data->get();

            foreach ($clients as $key => $value) {
                $req_exists = DeferRequest::where('client_id',$value->client_id)->exists();
                $compl_exists = Complaint::where('client_id',$value->client_id)->exists();
                $clients[$key]->is_request = 0;
                $clients[$key]->is_complaint = 0;
                if ($req_exists) {
                    $clients[$key]->is_request = 1;
                }
                if ($compl_exists) {
                    $clients[$key]->is_complaint = 1;
                }
            }

            foreach ($clients as $key => $client) {
                $exist_requests = DB::table('requests')
                ->where('client_id', $client->id)
                ->exists();
                $exist_complaints = DB::table('complaints')
                ->where('client_id', $client->id)
                ->exists();
                if ($exist_requests) {
                    $clients[$key]->is_deferd = 1;
                }else{
                    $clients[$key]->is_deferd = 0;
                }
                $clients[$key]->is_client_in_wating = 0;

                if ($client->is_subscription_in_wating) {
                    $clients[$key]->is_client_in_wating = 1;
                }

                if ($exist_complaints) {
                    $clients[$key]->is_complaint = 1;
                }else{
                    $clients[$key]->is_complaint = 0;
                }

                $client_lables = DB::table('client_labels')
                ->select(DB::raw('group_concat(DISTINCT  label) as lables'))
                ->where('client_id', $client->id)
                ->groupBy('client_id')
                ->first();
                $clients[$key]->lables = @$client_lables->lables;
            }

            Session::forget('back_complaints_url');
            Session::put('back_complaints_url', URL::current());
            
            Session::forget('back_request_url');
            Session::put('back_request_url', URL::current());

            Session::forget('back_lables_url');
            Session::put('back_lables_url', URL::current());

            Session::forget('back_profiles_url');
            Session::put('back_profiles_url', URL::current());


            return view('backend.admin.clients.nutri_index',compact('clients','filter'))->with('no', 1);

        }else{

            $clients = Client::latest();

            $filter = $request->input('filter');

            if ($request->has('filter')) {
                if ($request->input('filter') == 'waiting') {
                    $clients->where('clients.is_subscription_in_wating',1);
                }
                if ($request->input('filter') == 'block') {
                    $clients->where('clients.blocked_from_app',1);
                }
                if ($request->input('filter') == 'unblock') {
                    $clients->where('clients.blocked_from_app',0);
                }
            }        

            $clients = $clients->get();


            foreach ($clients as $key => $client) {

             $client_lables = DB::table('client_labels')
             ->select(DB::raw('group_concat(DISTINCT  label) as lables'))
             ->where('client_id', $client->id)
             ->groupBy('client_id')
             ->first();
             $clients[$key]->lables = @$client_lables->lables;

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
            $clients[$key]->is_client_in_wating = 0;
            if ($client_data->is_blocked) {
                $clients[$key]->is_client_blocked = 1;
            }
            if ($client_data->is_subscription_in_wating) {
                $clients[$key]->is_client_in_wating = 1;
            }
            if (@$user_data->is_blocked && $client_data->nutri_blocked) {
                $clients[$key]->is_nutri_blocked = 1;
            }
            $clients[$key]->nutri_name = @$user_data->name;
        }


        Session::forget('back_notes_url');
        Session::put('back_notes_url', route('clients.index'));
        Session::forget('back_lables_url');
        Session::put('back_lables_url', URL::current());
        Session::forget('back_defer_client_url');
        Session::put('back_defer_client_url', URL::current());
        Session::forget('back_profiles_url');
        Session::put('back_profiles_url', URL::current());

            // echo "<pre>";print_r($clients);exit;

        return view('backend.admin.clients.index',compact('clients','filter'))->with('no', 1);
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::get(['id','name']);
        return view('backend.admin.clients.create',compact('packages'));
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
         'firstname' => 'required',
         'email' => 'required|email|unique:clients,email',
         'password' => 'required',
     ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if ($request->has('status')) {

            $input['status'] = $request->status;

        }else{

            $input['status'] = "off";
        }

        $user = Client::create($input);

        $validity = Package::where('id', $request->package)->value('validity');
        $valid_upto = Carbon::now()->addDays($validity);
        $today_date = date('Y-m-d');
        $subscription_settings = DB::table('subscription_settings')->first();

        $is_subscription_in_wating = 0;

        if ($subscription_settings->subscriptions_reached >= $subscription_settings->subscriptions_limit) 
        {
            if ($subscription_settings->subscriptions_wating_list_reached >= $subscription_settings->subscriptions_watinglist_limit) 
            {
                DB::table('subscription_settings')->update(['accept_subscriptions' => 0]);
                DB::table('subscription_settings')->update(['close_subscriptions' => 1]);
            }
            else
            {
                DB::table('subscription_settings')->update(['subscriptions_wating_list_reached'=> DB::raw('subscriptions_wating_list_reached+1')]);
                $is_subscription_in_wating = 1;
            }
        }
        else
        {
            DB::table('subscription_settings')->update(['subscriptions_reached' => DB::raw('subscriptions_reached+1')]);
        }

        Client::where('id', $user->id)->update(['package_id' => $request->package, 'validity' => $valid_upto, 'subscription_date' => $today_date,'is_subscription_in_wating' => $is_subscription_in_wating,'subscription_wating_datetime'=>now()]);

        $nutritionists = DB::table('nutritionist_clients')
        ->select('nutritionist_id', DB::raw('count(*) as client_total'))
        ->groupBy('nutritionist_id')
        ->inRandomOrder()
        ->get();

        $no_of_clients_assign_to_nutritionist = DB::table('settings')->where('name','no_of_clients_assign_to_nutritionist')->value('value');

        foreach($nutritionists as $nutritionist){
            if($nutritionist->client_total < $no_of_clients_assign_to_nutritionist){
                DB::table('nutritionist_clients')->insert(['client_id'=>$user->id,'table_status'=>'due','workout_status'=>'due','nutritionist_id'=>$nutritionist->nutritionist_id]);
                break;
            }
        }

        return redirect()->route('clients.index')->with('success','Client Created successfully');
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
        $packages = Package::get(['id','name']);
        $client = Client::find($id);
        return view('backend.admin.clients.edit',compact('client','packages'));
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
        $client = CLient::find($id);
        $client->firstname = $request->firstname;
        $client->lastname = $request->lastname;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->gender = $request->gender;
        if ($request->has('status')) {

            $client->status = $request->status;

        }else{

            $client->status = "off";
        }
        $client->save();
        return redirect()->route('clients.index')
        ->with('success','Client Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tokens = CLient::where('id',$id)->with('tokens')->first();
        foreach($tokens['tokens'] as $token) {
            $token->revoke();
        }
        
        $client = CLient::where('id',$id)->delete();
        DB::table('nutritionist_clients')->where('client_id', $id)->delete();
        DB::table('requests')->where('client_id', $id)->delete();
        DB::table('notes')->where('client_id', $id)->delete();
        DB::table('admin_requests')->where('client_id', $id)->delete();
        DB::table('admin_requests')->where('client_id', $id)->delete();
        DB::table('cart')->where('client_id', $id)->delete();
        DB::table('client_tables')->where('client_id', $id)->delete();
        DB::table('client_workouts')->where('client_id', $id)->delete();
        DB::table('complaints')->where('client_id', $id)->delete();
        DB::table('diet_postings')->where('client_id', $id)->delete();
        DB::table('diet_posting_comments')->where('client_id', $id)->delete();
        DB::table('notification_histories')->where('client_id', $id)->delete();
        DB::table('transactions')->where('client_id', $id)->delete();
        DB::table('intake_substances')->where('client_id', $id)->delete();
        DB::table('intake_substance_comments')->where('client_id', $id)->delete();
        DB::table('client_labels')->where('client_id', $id)->delete();
        
        return redirect()->route('clients.index')
        ->with('warning','Client Deleted successfully');
    }

    public function deleteimage(){
        //
    }
}
