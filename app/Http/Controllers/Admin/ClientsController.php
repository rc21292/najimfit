<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients = Client::latest()->get();
        return view('backend.admin.clients.index',compact('clients'))->with('no', 1);
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
        if($nutritionist->client_total < 30){
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
