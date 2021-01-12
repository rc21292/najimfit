<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    	$roles = \Spatie\Permission\Models\Role::withCount('users')->get();

    	return view('backend.admin.teams.index',compact('roles'));

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
    public function show($role_name)
    {
    	$roles = \Spatie\Permission\Models\Role::withCount('users')->get();
    	$users = User::role($role_name)
    	->get();

    	return view('backend.admin.teams.employees',compact('users','roles','role_name'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user = User::where('id',$id)->first();
    	$active_clients = DB::table('nutritionist_clients')->join('clients','clients.id','=','nutritionist_clients.client_id')->select('nutritionist_clients.*')->where('nutritionist_clients.nutritionist_id',$id)->where('clients.package_id','!=','null')->count();
    	$total_clients = DB::table('nutritionist_clients')->where('nutritionist_id',$id)->count();
    	$pending_tables = DB::table('nutritionist_clients')->where('nutritionist_id',$id)->where('table_status','due')->count();
    	$pending_workouts = DB::table('nutritionist_clients')->where('nutritionist_id',$id)->where('workout_status','due')->count();
    	$renewal_table = DB::table('nutritionist_clients')->where('nutritionist_id',$id)->where('table_status','posted')->count();
    	$renewal_workout = DB::table('nutritionist_clients')->where('nutritionist_id',$id)->where('workout_status','posted')->count();
    	$total_complaints = DB::table('complaints')->where('nutritionist_id',$id)->count();
    	$pending_complaints = DB::table('complaints')->where('nutritionist_id',$id)->where('status','0')->count();

    	return view('backend.admin.teams.info',compact('user', 'total_clients','active_clients','pending_tables','pending_workouts','renewal_table','renewal_workout','total_complaints','pending_complaints'));
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
