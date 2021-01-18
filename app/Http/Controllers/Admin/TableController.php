<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Question;
use App\Models\Meals\TableCategory;
use App\Models\Meals\Meal;
use App\Models\Package;
use App\Models\ClientTable;
use DB;
use Session;
use Auth;
use Spatie\Permission\Traits\HasRoles;
function __construct()
{
    $this->middleware('permission:admin-table-list|admin-table-edit', ['only' => ['index','show']]);
    $this->middleware('permission:admin-table-store', ['only' => ['store']]);
    $this->middleware('permission:admin-table-edit', ['only' => ['edit']]);
    $this->middleware('permission:admin-table-clients', ['only' => ['allclients']]);
    
}

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist'){

            return redirect()->route('assign-table.show',Auth::User()->id);

        }else{

        $total_clients = Client::count();
        $users = User::role('Nutritionist')
        ->join('nutritionist_clients','nutritionist_clients.nutritionist_id','=','users.id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('users.name','users.id','users.created_at', DB::raw("COUNT(clients.id) as clients_count"))->groupBy("nutritionist_clients.nutritionist_id",'users.name','users.id','users.created_at')->where('table_status','due')
        ->get();

        return view('backend.admin.tables.index',compact('users','total_clients'));

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

        $clientmeal = new ClientTable;
        $clientmeal->calories = $request->calories;
        $clientmeal->carbs = $request->carbs;
        $clientmeal->fat = $request->fat;
        $clientmeal->protein = $request->protein;
        $clientmeal->client_id = Session::get('client');
        $clientmeal->table_id = Session::get('table_id');
        // $clientmeal->breakfast = $request->breakfast;
        $clientmeal->breakfast = implode(', ', $request->breakfast);
        $clientmeal->snacks1 = implode(', ', $request->snack1);
        $clientmeal->lunch = implode(', ', $request->lunch);
        $clientmeal->snacks2 = implode(', ', $request->snack2);
        $clientmeal->dinner = implode(', ', $request->dinner);
        $clientmeal->snacks3 = implode(', ', $request->snack3);
        $clientmeal->calorie_range = Session::get('range');
        $clientmeal->save();

        DB::table('nutritionist_clients')->where('client_id',Session::get('client'))->update(['table_status'=>'posted']);
        return redirect()->route('assign-table.index')->with(['success'=>'Table Assigned Successfully!']);

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
        ->where('nutritionist_clients.nutritionist_id',$id)->where('nutritionist_clients.table_status','due')
        ->get();

        return view('backend.admin.tables.client',compact('clients'))->with('no', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$tables = TableCategory::all();
        $selected_table= ClientTable::where('client_id',$id)->first();
        if ($selected_table) {
            $table_id = $selected_table->table_id;
            $range = $selected_table->calorie_range;
            Session::put('table_id', $table_id);
            Session::put('client', $id);
            Session::put('range', $range);
        }else{
            $table_id = 0;
            $range = 0;
            Session::put('table_id', 0);
            Session::put('client', 0);
            Session::put('range', 0);
        }
    	$answers = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.question','client_answers.answer')->where('client_answers.client_id',$id)->get();
    	$client = Client::find($id);
    	$weight = DB::table('client_answers')->where('client_id',$id)->where('question_id',9)->value('answer');

        $height = DB::table('client_answers')->where('client_id',$id)->where('question_id',10)->value('answer');

        if ($selected_table) {
            return view('backend.admin.renewtables.table',compact('client','weight','height','tables','answers','selected_table','table_id','range'));
        }else{
            return view('backend.admin.tables.table',compact('client','weight','height','tables','answers','selected_table','table_id','range'));
        }
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
        ->where('nutritionist_clients.table_status','due')
        ->get();
        return view('backend.admin.tables.client',compact('clients'))->with('no', 1);
    }

    public function setsession(Request $request){
        Session::put('table_id', $request->table);
        Session::put('client', $request->client);
        Session::put('range', $request->range);
    }
    public function diettemplate(){
        $client_id = Session::get('client');
        $client = Client::find($client_id);
        $answers = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.question','client_answers.answer')->where('client_answers.client_id',$client_id)->get();
        $weight = DB::table('client_answers')->where('client_id',$client_id)->where('question_id',9)->value('answer');
        $height = DB::table('client_answers')->where('client_id',$client_id)->where('question_id',10)->value('answer');
        $table_id = Session::get('table_id');
        $table =TableCategory::find($table_id)->name;
        $breakfasts = Meal::where('table_id',$table_id)->where('type','breakfast')->get();
        $snacks = Meal::where('table_id',$table_id)->where('type','snacks')->get();
        $dinners = Meal::where('table_id',$table_id)->where('type','dinner')->get();
        $lunchs = Meal::where('table_id',$table_id)->where('type','lunch')->get();
        $client_package = Client::find($client_id)->select('validity','package_id')->first();
        $today = date("Y-m-d");
        if($client_package->validity >= $today){
            $days = Package::where('id', $client_package->package_id)->value('validity');
        }else{
            $days = 0;
        }

        return view('backend.admin.tables.template',compact('client','answers','weight','height','table','breakfasts','snacks','lunchs','dinners','days'))->with('no', 1);
    }
    
    public function foodinfo(Request $request)
    {
      $calories = Meal::whereIn('id', [$request->breakfast, $request->snack1 ,$request->lunch, $request->snack2, $request->dinner, $request->snack3])->sum('calories');
      $carbs = Meal::whereIn('id', [$request->breakfast, $request->snack1 ,$request->lunch, $request->snack2, $request->dinner, $request->snack3])->sum('carbs');
      $fat = Meal::whereIn('id', [$request->breakfast, $request->snack1 ,$request->lunch, $request->snack2, $request->dinner, $request->snack3])->sum('fat');
      $protein = Meal::whereIn('id', [$request->breakfast, $request->snack1 ,$request->lunch, $request->snack2, $request->dinner, $request->snack3])->sum('protein');
      return response()->json(['calories'=> $calories, 'carbs'=> $carbs, 'fat'=> $fat, 'protein'=> $protein]);

  }
}
