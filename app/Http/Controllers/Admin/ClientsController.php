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

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            }
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
            }

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
        return view('backend.admin.clients.create');
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
        $input['password'] = Hash::make($input['password']);
        if ($request->has('status')) {

           $input['status'] = $request->status;

       }else{

        $input['status'] = "off";
    }
    $user = Client::create($input);
    $nutritionists = DB::table('nutritionist_clients')
    ->select('nutritionist_id', DB::raw('count(*) as client_total'))
    ->groupBy('nutritionist_id')
    ->get();

    foreach($nutritionists as $nutritionist){
        if($nutritionist->client_total < 6){
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
        $client = Client::find($id);

        $mobile_no = preg_replace(
     '/\+(?:998|996|995|994|993|992|977|976|975|974|973|972|971|970|968|967|966|965|964|963|962|961|960|886|880|856|855|853|852|850|692|691|690|689|688|687|686|685|683|682|681|680|679|678|677|676|675|674|673|672|670|599|598|597|595|593|592|591|590|509|508|507|506|505|504|503|502|501|500|423|421|420|389|387|386|385|383|382|381|380|379|378|377|376|375|374|373|372|371|370|359|358|357|356|355|354|353|352|351|350|299|298|297|291|290|269|268|267|266|265|264|263|262|261|260|258|257|256|255|254|253|252|251|250|249|248|246|245|244|243|242|241|240|239|238|237|236|235|234|233|232|231|230|229|228|227|226|225|224|223|222|221|220|218|216|213|212|211|98|95|94|93|92|91|90|86|84|82|81|66|65|64|63|62|61|60|58|57|56|55|54|53|52|51|49|48|47|46|45|44\D?1624|44\D?1534|44\D?1481|44|43|41|40|39|36|34|33|32|31|30|27|20|7|1\D?939|1\D?876|1\D?869|1\D?868|1\D?849|1\D?829|1\D?809|1\D?787|1\D?784|1\D?767|1\D?758|1\D?721|1\D?684|1\D?671|1\D?670|1\D?664|1\D?649|1\D?473|1\D?441|1\D?345|1\D?340|1\D?284|1\D?268|1\D?264|1\D?246|1\D?242|1)\D?/'
    , ''
    , $client->phone
    );

        $client->phone = $mobile_no;
        return view('backend.admin.clients.edit',compact('client'));
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
        $client = CLient::where('id',$id)->delete();
        return redirect()->route('danger.index')
        ->with('warning','Client Deleted successfully');
    }

    public function deleteimage(){
        //
    }
}
