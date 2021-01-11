<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;

class MeetingController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetings = DB::table('meetings')->get();
    	
        return view('backend.admin.meeting.index',compact('meetings'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id','!=',Auth::User()->id)->get();
    	
        return view('backend.admin.meeting.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $meeting_id = DB::table('meetings')->insertGetId([
        	'name' => $request->name,
            'description' => $request->description,
            'date' =>$request->date,
            'start' => $request->start,
            'end' =>  $request->end,
            'link' => $request->link,
            'participants' => json_encode($request->users)
        ]);

        foreach($request->users as $user){
        	DB::table('meeting_notifications')->insert([
        	'user_id' => $user,
            'meeting_id' => $meeting_id,
            'message' => 'You have been invited by Admin to Join '.$request->name. ' on'. $request->date .'. Click Here to Join <a href="'.$request->link.'"></a>',
        ]);
        }

        return redirect()->route('meeting.index')->with(['success'=>'Meeting Saved and All Participants have been invited Successfully!']);
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
    	$users = User::where('id','!=',Auth::User()->id)->get();
        $meeting = DB::table('meetings')->where('id',$id)->first();
        $meeting->participants = json_decode($meeting->participants);
        return view('backend.admin.meeting.edit',compact('meeting','id','users'));
        
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
        $meeting_id = DB::table('meetings')->where('id',$id)->update([
        	'name' => $request->name,
            'description' => $request->description,
            'date' =>$request->date,
            'start' => $request->start,
            'end' =>  $request->end,
            'link' => $request->link,
            'participants' => json_encode($request->users)
        ]);
        return redirect()->route('meeting.index')->with(['success'=>'Meeting has been Updated Successfully !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('meetings')->where('id',$id)->delete();
        DB::table('meeting_notifications')->where('meeting_id',$id)->delete();

        return back()->with(['warning'=>'Meeting Deleted Successfully!']);
    }
}
