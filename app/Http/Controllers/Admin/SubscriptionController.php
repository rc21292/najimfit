<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\DeferRequest;
use App\Models\Package;
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

        $active_package_id = Package::where('name','Fitnes Junkie')->value('id');
        $active_subscriptions = DB::table('clients')
        ->where('package_id' ,$active_package_id)
        ->count('id');

        $online_active_subscriptions = DB::table('clients')
        ->whereNotNull('package_id')
        ->where('package_id', '!=' ,$active_package_id)
        ->count('id');

        $subscription_settings = DB::table('subscription_settings')
        ->select('subscriptions_limit','subscriptions_watinglist_limit','accept_subscriptions','close_subscriptions')
        ->first();

        $waiting_subscriptions = DB::table('clients')
        ->whereNull('package_id')
        ->count('id');

        DB::connection()->enableQueryLog();
        $subscriptions_by_nutritionists = DB::table('nutritionist_clients')
            ->join('clients','clients.id','nutritionist_clients.client_id')
            ->join('users','users.id','nutritionist_clients.nutritionist_id')
            ->select('nutritionist_clients.nutritionist_id','users.name', DB::raw('group_concat(client_id) as client_ids'), DB::raw('count(client_id) as total'))
            ->where('package_id', '!=' ,$active_package_id)
            ->whereNotNull('package_id')
            ->groupBy('nutritionist_clients.nutritionist_id')
            ->get();

            $total_per_nutritionist = 0;
            foreach($subscriptions_by_nutritionists as $key => $subscriptions_by_nutritionist) {
                $total_per_nutritionist += $subscriptions_by_nutritionist->total;
            }

            $subscriptions_by_nutritionists_total = count($subscriptions_by_nutritionists);

            $average_per_nutritionist = round($total_per_nutritionist/$subscriptions_by_nutritionists_total);


            $active_subscriptions_by_nutritionists = DB::table('nutritionist_clients')
            ->join('clients','clients.id','nutritionist_clients.client_id')
            ->join('users','users.id','nutritionist_clients.nutritionist_id')
            ->select('nutritionist_clients.nutritionist_id','users.name', DB::raw('group_concat(client_id) as client_ids'), DB::raw('count(client_id) as total'))
            ->where('package_id',$active_package_id)
            ->groupBy('nutritionist_clients.nutritionist_id')
            ->get();

            /*Fitnes Junkie
center packages*/

            $queries = DB::getQueryLog();
        $last_query = end($queries);
        
        $active_total_per_nutritionist = 0;
            foreach($active_subscriptions_by_nutritionists as $key => $active_subscriptions_by_nutritionist) {
                $active_total_per_nutritionist += $active_subscriptions_by_nutritionist->total;
            }

        $active_subscriptions_by_nutritionists_total = count($active_subscriptions_by_nutritionists);

            $active_average_per_nutritionist = round($active_total_per_nutritionist/$active_subscriptions_by_nutritionists_total);


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

        return view('backend.admin.controls.subscriptions.index',compact('clients','active_subscriptions','waiting_subscriptions','subscriptions_by_nutritionists','subscriptions_by_nutritionists_total','average_per_nutritionist','subscription_settings','active_subscriptions_by_nutritionists','online_active_subscriptions','active_average_per_nutritionist','subscription_settings'))->with('no', 1);
    }

    public function customMessages()
    {        
        $subscription_settings = DB::table('subscription_settings')
        ->select('accept_subscription_message','waitinglist_subscription_message')
        ->first();

        return view('backend.admin.controls.subscriptions.custom_messages',compact('subscription_settings'))->with('no', 1);
    }

    public function updateCustomMessages(Request $request)
    {
       DB::table('subscription_settings')->update(['accept_subscription_message' => $request->accept_subscription_message]);      
        DB::table('subscription_settings')->update(['waitinglist_subscription_message' => $request->waitinglist_subscription_message]);
        return redirect()->back()->with('success', 'Custom messages updated!');
    }

    public function AcceptSubscriptions(Request $request)
    {
        DB::table('packages')->update(['is_accept_subscriptions' => 1]); 
        DB::table('subscription_settings')->update(['accept_subscriptions' => 1]);      
        DB::table('subscription_settings')->update(['close_subscriptions' => 0]);     
        return redirect()->back()->with('success', 'Successfully enabled Accepting Subscriptions!');
    }

    public function CloseSubscriptions(Request $request)
    {   
        DB::table('packages')->update(['is_accept_subscriptions' => 0]);
        DB::table('subscription_settings')->update(['close_subscriptions' => 1]);     
        DB::table('subscription_settings')->update(['accept_subscriptions' => 0]);     
        return redirect()->back()->with('success', 'Successfully disabled Accepting Subscriptions!');
    }

    public function cancelSubscriptionByClient(Request $request)
    {
        DB::table('clients')->where('id',$request->client)->update(['is_subscription_canceled' => 1]); 
        return redirect()->route('subscriptions.index')->with('success','Client Blocked from app successfully!');
    }

    public function CancelSubscription(Request $request)
    {
        $clients = Client::latest()->select('firstname','lastname','id')->get();

        return view('backend.admin.controls.subscriptions.cancel_subscription',compact('clients'))->with('no', 1);
    }


    public function uncancelSubscriptionByClient(Request $request)
    {
        DB::table('clients')->where('id',$request->client)->update(['is_subscription_canceled' => 0]); 
        return redirect()->route('subscriptions.index')->with('success','Client Blocked from app successfully!');
    }

    public function UncancelSubscription(Request $request)
    {
        $clients = Client::latest()->where('is_subscription_canceled',1)->select('firstname','lastname','id')->get();

        return view('backend.admin.controls.subscriptions.uncancel_subscription',compact('clients'))->with('no', 1);
    }

    public function updateSuscriptionSettings(Request $request)
    {
        DB::table('subscription_settings')->update(['subscriptions_limit' => $request->subscriptions_limit, 'subscriptions_watinglist_limit' => $request->subscriptions_watinglist_limit]); 

        return redirect()->back()->with('success', 'Successfully updated subscription Settings!');
    }

    public function ExtendSubscription(Request $request)
    {
        $clients = Client::latest()->select('firstname','lastname','id')->get();

        return view('backend.admin.controls.subscriptions.extend_subscription',compact('clients'))->with('no', 1);
    }

    public function ExtendSubscriptionByClient(Request $request)
    {
        DB::table('clients')->where('id',$request->client)->update(['extend_days' => $request->days]); 

        $clients = Client::find($request->client);
        $current_validity = $clients->validity;

        $date = date_create($current_validity);

        date_add($date, date_interval_create_from_date_string("$request->days days")); 

        $valid_upto =  date_format($date, "Y-m-d"); 

        $clients->validity = $valid_upto;
        $clients->extend_days = $request->days;
        $clients->save(); 
        return redirect()->route('subscriptions.index')->with('success','Client Suscription extend successfully!');
    }    

    public function BlockUserFromApp(Request $request)
    {
        $clients = Client::latest()->select('firstname','lastname','id')->get();

        return view('backend.admin.controls.subscriptions.block_user',compact('clients'))->with('no', 1);
    }

    public function UnblockUserFromApp(Request $request)
    {
        $clients = Client::where('blocked_from_app',1)->latest()->select('firstname','lastname','id')->get();

        return view('backend.admin.controls.subscriptions.unblock_user',compact('clients'))->with('no', 1);
    }


    public function BlockClientFromApp(Request $request)
    {
        DB::table('clients')->where('id',$request->client)->update(['blocked_from_app' => 1]); 

        return redirect()->route('subscriptions.index')->with('success','Client Blocked from app successfully!');
    }


    public function UnblockClientFromApp(Request $request)
    {
        DB::table('clients')->where('id',$request->client)->update(['blocked_from_app' => 0]); 

        return redirect()->route('subscriptions.index')->with('success','Client Unblocked from app successfully!');
    }

    public function notifyClients()
    {
         $clients = Client::whereNull('package_id')->get(); 
         return view('backend.admin.controls.subscriptions.notify_clients',compact('clients'))->with('no', 1);
    }

    public function notifyClientMessage(Request $request)
    {
        // echo "<pre>";print_r($request->all());"</pre>";exit;
        return redirect()->route('subscriptions.index')->with('success','Client Unblocked from app successfully!');
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
