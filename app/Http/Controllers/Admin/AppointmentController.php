<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = DB::table('appointments')->get();
        return view('backend.admin.appointment.index',compact('appointments'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::table('appointments')->insert([

            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "date" =>$request->date,
            "time" =>$request->time,
            "status" => isset($request->status) ? "1" : "0",

        ]);

        return redirect()->route('appointments.index')->with('success','Appointment Added successfully');
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
        $appointment = DB::table('appointments')->where("id",$id)->first();
        return view('backend.admin.appointment.edit',compact('appointment','id'));
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
         DB::table('appointments')->where('id', $id)->update([

            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "date" =>$request->date,
            "time" =>$request->time,
            "status" => isset($request->status) ? "1" : "0",

        ]);

        return redirect()->route('appointments.index')->with('success','Appointment Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        DB::table('appointments')->where('id', $id)->delete();
        return redirect()->route('appointments.index')->with('delete','Appointment Deleted successfully');
    }
}
