<?php

namespace App\Http\Controllers\Admin;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use DB;
use Auth;

class FullCalendarController extends Controller
{
  public function index()

  {

    if(request()->ajax()) 

    {



     $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');

     $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');



         // $data = Event::where('user_id',Auth::User()->id)->whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);

         // $data = DB::table('appointments')->whereDate('date', '>=', $start)->select('appointments.*', DB::raw('CONCAT(firstname, lastname) AS title'), 'appointments.date as start')->get();


     $mc = Event::where('user_id',Auth::User()->id)->whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
     $sm = DB::table('appointments')->whereDate('start', '>=', $start)->select('appointments.*', DB::raw('CONCAT("App: " ,firstname, " ", lastname) AS title'))->get();
     $data = array_merge($mc->toArray(), $sm->toArray());

     return Response::json($data);

   }

   return view('backend.admin.calender.calender');

 }





 public function create(Request $request)

 {  

  $insertArr = [ 'user_id' => Auth::User()->id, 

  'title' => $request->title,

  'start' => $request->start,

  'end' => $request->end

];

$event = Event::insert($insertArr);   

return Response::json($event);

}





public function update(Request $request)

{   

  $where = array('id' => $request->id);

  $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];

  $event  = Event::where($where)->update($updateArr);



  return Response::json($event);

} 


public function save_event(Request $request){

  $event = new Event;
  $event->user_id =Auth::User()->id;
  $event->title = $request->title;
  $event->start =  $request->start;
  $event->end =  $request->end;
  $event->comments =  $request->comments;
  $event->type ="events";
  $event->color ="yellow";
  $event->save();
  return redirect()->route('fullcalendar-index')->with('success','Event Added successfully');;
}

public function save_appointment(Request $request){
  DB::table('appointments')->insert([

    "firstname" => $request->firstname,
    "lastname" => $request->lastname,
    "email" => $request->email,
    "phone" => $request->phone,
    "gender" => $request->gender,
    "start" =>$request->appointment_start,
    "comments" =>$request->comments,
    "type" => "appointments",
    "color" =>"#ffb3b3",
    "status" => isset($request->status) ? "1" : "0",

  ]);

  return redirect()->route('fullcalendar-index')->with('success','Appointment Added successfully');
}





public function destroy(Request $request)

{

  $event = Event::where('id',$request->id)->delete();



  return Response::json($event);

}    

public function delete(Request $request)

{

  $event = DB::table('appointments')->where('id',$request->id)->delete();



  return Response::json($event);

}    
}
