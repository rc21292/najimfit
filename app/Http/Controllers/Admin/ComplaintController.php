<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Client;
use Auth;
use Session;
use URL;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
      $this->middleware(['permission:complaints']);
    }
    
    public function index()
    {
        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist')
        {

            /*Session::forget('back_complaints_url');
            Session::put('back_complaints_url', URL::previous());*/

            $complaints = Complaint::where('nutritionist_id',$user->id)->latest()->get();
            return view('backend.admin.complaints.nutritionist.index',compact('complaints'))->with('no', 1);
        }else{
            $complaints = Complaint::latest()->get();
            return view('backend.admin.complaints.index',compact('complaints'))->with('no', 1);
        }
    }

    public function deferClient($id)
    {
        $client_id = DB::table('complaints')->where('id',$id)->value('client_id');
        $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$client_id)->value('nutritionist_id');
        $client_name = DB::table('clients')->where('id',$client_id)->value('firstname').' '.DB::table('clients')->where('id',$client_id)->value('lastname');
        $nutritionist_name = User::where('id',$nutritionist_id)->value('name');
        $nutritionists = User::whereNotIn('id',[$nutritionist_id,'1'])->get();
        return view('backend.admin.complaints.defer_client',compact('id','nutritionists','nutritionist_name','client_name','client_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('backend.admin.complaints.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function assignToNutritionist(Request $request)
    {
        DB::table('nutritionist_clients')->where('client_id',$request->client_id)->update(['nutritionist_id'=>$request->nutritionist]);
        DB::table('complaints')->where('id',$request->id)->where('client_id',$request->client_id)->update(['status'=>1]);
        $complaints = Complaint::all();
        return redirect()->route('complaints.index')->with('success','Client Assigned to Nutritionist successfully');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $nutritionist_id = DB::table('nutritionist_clients')->where('client_id',$input['client_id'])->value('nutritionist_id');
        $user = User::find($nutritionist_id);
        $client = Client::where('id',$input['client_id'])->first();
        $input['nutritionist_id'] = $nutritionist_id;
        $input['nutritionist_name'] = $user->name;
        $input['client_name'] = $client->firstname.' '.$client->lastname;

        $user = Complaint::create($input);
        
        return redirect()->route('complaints.index')->with('success','Complaint Created successfully');
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
