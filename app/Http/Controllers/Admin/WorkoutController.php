<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Question;
use App\Models\WorkoutCategory;
use App\Models\Exercise;
use App\Models\Package;
use App\Models\ClientWorkout;
use DB;
use Session;
use Auth;
use URL;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
      $this->middleware(['permission:workouts']);
      $this->middleware(['permission:assign-workout']);
      
    }
    
    public function index()
    {
        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist'){

            return redirect()->route('assign-workout.show',Auth::User()->id);

        }else{

            $total_clients = Client::count();
            $users = User::role('Nutritionist')
            ->join('nutritionist_clients','nutritionist_clients.nutritionist_id','=','users.id')
            ->join('admin_nutritionist','admin_nutritionist.nutritionist_id','=','users.id')
            ->join('clients','clients.id','=','nutritionist_clients.client_id')
            ->select('users.name','users.id','users.created_at', DB::raw("COUNT(clients.id) as clients_count"))->groupBy("nutritionist_clients.nutritionist_id",'users.name','users.id','users.created_at')->where('workout_status','due')->where('admin_nutritionist.admin_id', Auth::User()->id)
            ->get();

            return view('backend.admin.workout.index',compact('users','total_clients'));
        }
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
       DB::table('client_workouts')->where('client_id',$request->client_id)->delete();
       foreach($request->days as $key => $value){
        foreach($value['exercises'] as $newkey => $exercise){
            ClientWorkout::Create(
                    ['client_id' => $request->client_id,'category' => $request->workout, 'day' => $value['day'], 'exercise' =>$exercise],
                    ['exercise' => $exercise , 'day' => $value['day']]
                );
        } 
        DB::table('nutritionist_clients')->where('client_id',$request->client_id)->update(['workout_status' => 'posted']);
    }

    return redirect()->route('workout-template',$request->client_id);



}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $clients = DB::table('nutritionist_clients')
      ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
      ->join('clients','clients.id','=','nutritionist_clients.client_id')
      ->select('clients.*','users.name','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
      ->where('nutritionist_clients.nutritionist_id',$id)->where('nutritionist_clients.workout_status','due')
      ->get();

      foreach ($clients as $key => $client) {

          $client_lables = DB::table('client_labels')
          ->select(DB::raw('group_concat(DISTINCT  label) as lables'))
          ->where('client_id', $client->client_id)
          ->groupBy('client_id')
          ->first();
          $clients[$key]->lables = @$client_lables->lables;
      }

      Session::forget('back_lables_url');
      Session::put('back_lables_url', URL::current());

      Session::forget('back_profiles_url');
      Session::put('back_profiles_url', URL::current());

      return view('backend.admin.workout.client',compact('clients'))->with('no', 1);
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Session::put('client_id', $id);
        $workouts = WorkoutCategory::all();
        $exercises = Exercise::all();
        $answers = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.question','client_answers.answer')->where('client_answers.client_id',$id)->get();
        $client = Client::find($id);
        $weight = DB::table('client_answers')->where('client_id',$id)->where('question_id',9)->value('answer');
        $no_days = ClientWorkout::where('client_id',$id)->max('day');
        $client_workouts = DB::table('client_workouts')->where('client_id',$id)->get();
        $category = DB::table('client_workouts')->where('client_id',$id)->value('category');
        $days = ClientWorkout::where('client_id',$id)->distinct('day')->count();

        $height = DB::table('client_answers')->where('client_id',$id)->where('question_id',10)->value('answer');

        Session::forget('back_cunsult_team_url');
        Session::put('back_cunsult_team_url', URL::current());
        
        return view('backend.admin.workout.table',compact('client','weight','height','workouts','answers','exercises','client_workouts','no_days','days','category'));
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
        DB::table('client_workouts')->where('id',$id)->delete();
        return redirect()->back();
    }

    public function allclients(){
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('admin_nutritionist','admin_nutritionist.nutritionist_id','=','users.id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.*','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        ->where('nutritionist_clients.workout_status','due')
        ->where('admin_nutritionist.admin_id', Auth::User()->id)
        ->get();

        foreach ($clients as $key => $client) {

          $client_lables = DB::table('client_labels')
          ->select(DB::raw('group_concat(DISTINCT  label) as lables'))
          ->where('client_id', $client->client_id)
          ->groupBy('client_id')
          ->first();
          $clients[$key]->lables = @$client_lables->lables;
        }

        Session::forget('back_lables_url');
        Session::put('back_lables_url', URL::current());

        Session::forget('back_profiles_url');
        Session::put('back_profiles_url', URL::current());

        return view('backend.admin.workout.client',compact('clients'))->with('no', 1);
    }
    public function setsession(Request $request){

    }

    public function workouttemplate($id){
        $no_days = ClientWorkout::where('client_id',$id)->max('day');
        $days = ClientWorkout::where('client_id',$id)->distinct('day')->count();
        $exercises = Exercise::all();
        $answers = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.question','client_answers.answer')->where('client_answers.client_id',$id)->get();
        $client = Client::find($id);
        $weight = DB::table('client_answers')->where('client_id',$id)->where('question_id',9)->value('answer');

        $height = DB::table('client_answers')->where('client_id',$id)->where('question_id',10)->value('answer');
        $workouts = DB::table('client_workouts')->join('exercises','exercises.id','=','client_workouts.exercise')->select('exercises.*','exercises.id as exercise_id','client_workouts.*')->where('client_id',$id)->get();
        return view('backend.admin.workout.template',compact('client','weight','height','answers','exercises','no_days','workouts','days'));
    }

    public function workoutinfo($id){
        $categories = WorkoutCategory::all();
        $exercise = Exercise::where('id',$id)->first();
        return view('backend.admin.workout.workout',compact('exercise','categories'));
    }

    public function getexercisesbycategory(Request $request){
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('exercises')
            ->where('id', 'query')
            ->get();
            $output = '<select class="form-control"  name="exercise" id="exercise" required="">';
            foreach($data as $row)
            {
                $output .= '
                <option value="'.$row->id.'">'.$row->name.'</option> ';
            }
            $output .= '</select>';
            echo $output;
        }
    }
    public function assigntemplate(Request $request){
        $id =  Session::get('client_id');
        foreach($request->sets as $workout_id => $value){
            DB::table('client_workouts')->where('id',$workout_id)->update(['sets' => $value]);
        }

        foreach($request->reps as $workout_id => $value){
            DB::table('client_workouts')->where('id',$workout_id)->update(['reps' => $value]);
        }
        foreach($request->category as $workout_id => $value){
            DB::table('client_workouts')->where('id',$workout_id)->update(['category' => $value]);
        }
        DB::table('nutritionist_clients')->where('client_id',Session::get('client_id'))->update(['workout_status'=>'posted']);
        return redirect()->route('renew-workout.index')->with(['success'=>'Workout Assigned Successfully!']);
    }
}
