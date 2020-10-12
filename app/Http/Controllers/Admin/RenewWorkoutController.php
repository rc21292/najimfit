<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class RenewWorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $total_clients = Client::count();
        $users = User::role('Nutritionist')
        ->join('nutritionist_clients','nutritionist_clients.nutritionist_id','=','users.id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('users.name','users.id','users.created_at', DB::raw("COUNT(clients.id) as clients_count"))->groupBy("nutritionist_clients.nutritionist_id",'users.name','users.id','users.created_at')->where('workout_status','posted')
        ->get();
        return view('backend.admin.workout.index',compact('users','total_clients'));
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

    public function allclients(){
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.*','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        ->where('nutritionist_clients.workout_status','posted')
        ->get();
        return view('backend.admin.workout.client',compact('clients'))->with('no', 1);
    }
    public function setsession(Request $request){

    }

    public function workouttemplate($id){

    }

    public function workoutinfo(Request $request){

    }
}
