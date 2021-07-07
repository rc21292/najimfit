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
use Spatie\Permission\Traits\HasRoles;
use Auth;
use URL;

class RenewTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
      $this->middleware(['permission:tables']);
      $this->middleware(['permission:renew-tables']);
      
    }

    public function index()
    {
        $user = Auth::User();
        $roles = $user->getRoleNames();
        $role_name =  $roles->implode('', ' ');

        if($role_name == 'Nutritionist'){

            return redirect()->route('renew-table.show',Auth::User()->id);

        }else{
        $total_clients = Client::count();
        $users = User::role('Nutritionist')
        ->join('nutritionist_clients','nutritionist_clients.nutritionist_id','=','users.id')
        ->join('admin_nutritionist','admin_nutritionist.nutritionist_id','=','users.id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('users.name','users.id','users.created_at', DB::raw("COUNT(clients.id) as clients_count"))->groupBy("nutritionist_clients.nutritionist_id",'users.name','users.id','users.created_at')->where('table_status','posted')->whereNotNull('clients.package_id')->where('admin_nutritionist.admin_id', Auth::User()->id)
        ->get();
    }
        return view('backend.admin.renewtables.index',compact('users','total_clients'));
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
        $clients = DB::table('nutritionist_clients')
        ->join('users','users.id','=','nutritionist_clients.nutritionist_id')
        ->join('clients','clients.id','=','nutritionist_clients.client_id')
        ->select('clients.*','users.name','nutritionist_clients.created_at as assigned_on','nutritionist_clients.client_id')
        ->where('nutritionist_clients.nutritionist_id',$id)->where('nutritionist_clients.table_status','posted')
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

        return view('backend.admin.renewtables.client',compact('clients'))->with('no', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        
        $tables = TableCategory::all();
        $answers = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.question','client_answers.answer')->where('client_answers.client_id',$id)->get();
        $client = Client::find($id);
        $weight = DB::table('client_answers')->where('client_id',$id)->where('question_id',9)->value('answer');

        $height = DB::table('client_answers')->where('client_id',$id)->where('question_id',10)->value('answer');

        Session::forget('back_cunsult_team_url');
        Session::put('back_cunsult_team_url', URL::current());

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
        $clientmeal = ClientTable::find($id);
        $clientmeal->calories = $request->calories;
        $clientmeal->carbs = $request->carbs;
        $clientmeal->fat = $request->fat;
        $clientmeal->protein = $request->protein;
        $clientmeal->client_id = $clientmeal->client_id;
        $clientmeal->table_id = Session::get('table_id');
        $clientmeal->breakfast = implode(', ', $request->breakfast);
        $clientmeal->snacks1 = implode(', ', $request->snack1);
        $clientmeal->lunch = implode(', ', $request->lunch);
        $clientmeal->dinner = implode(', ', $request->dinner);
        $clientmeal->calorie_range = Session::get('range');
        $clientmeal->save();

        DB::table('nutritionist_clients')->where('client_id',Session::get('client'))->update(['table_status'=>'posted']);
        return redirect()->route('renew-table.index')->with('success','Table Renewed successfully');
       ;
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
        ->where('nutritionist_clients.table_status','posted')
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

        return view('backend.admin.renewtables.client',compact('clients'))->with('no', 1);
    }

    public function setsession(Request $request){
        Session::put('table_id', $request->table);
        Session::put('client', $request->client);
        Session::put('range', $request->range);
    }
    public function diettemplate($id){

        $selected_meal = ClientTable::find($id); 

        $selected_meal_breakfast = explode(', ', $selected_meal->breakfast);
        $selected_meal_lunch = explode(', ', $selected_meal->lunch);
        $selected_meal_dinner = explode(', ', $selected_meal->dinner);
        $selected_meal_snacks1 = explode(', ', $selected_meal->snacks1);
        $selected_meal_snacks2 = explode(', ', $selected_meal->snacks2);
        $selected_meal_snacks3 = explode(', ', $selected_meal->snacks3);
        
        $client = Client::find($selected_meal->client_id);

        $answers = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.question','client_answers.answer')->where('client_answers.client_id',$client->id)->get();
        $weight = DB::table('client_answers')->where('client_id',$client->id)->where('question_id',9)->value('answer');
        $height = DB::table('client_answers')->where('client_id',$client->id)->where('question_id',10)->value('answer');
        $table_id = $selected_meal->table_id;
        $table =TableCategory::find($table_id)->name;
        $breakfasts = Meal::where('table_id',$table_id)->where('type','breakfast')->get();
        $snacks = Meal::where('table_id',$table_id)->where('type','snacks')->get();
        $dinners = Meal::where('table_id',$table_id)->where('type','dinner')->get();
        $lunchs = Meal::where('table_id',$table_id)->where('type','lunch')->get();
        $client_package = Client::find($client->id)->select('validity','package_id')->first();
        $today = date("Y-m-d");
        if($client_package->validity >= $today){
            $days = Package::where('id', $client_package->package_id)->value('validity');
        }else{
            $days = 0;
        }

        return view('backend.admin.renewtables.template',compact('selected_meal','client','answers','weight','height','table','breakfasts','snacks','lunchs','dinners','days','selected_meal_breakfast','selected_meal_snacks1', 'selected_meal_snacks2', 'selected_meal_snacks3' ,'selected_meal_dinner','selected_meal_lunch'))->with('no', 1);
    }
    
    public function foodinfo(Request $request){
      $calories = Meal::whereIn('id', [$request->breakfast, $request->snack1 ,$request->lunch, $request->dinner])->sum('calories');
      $carbs = Meal::whereIn('id', [$request->breakfast, $request->snack1 ,$request->lunch, $request->dinner])->sum('carbs');
      $fat = Meal::whereIn('id', [$request->breakfast, $request->snack1 ,$request->lunch, $request->dinner])->sum('fat');
      $protein = Meal::whereIn('id', [$request->breakfast, $request->snack1 ,$request->lunch, $request->dinner])->sum('protein');
      return response()->json(['calories'=> $calories, 'carbs'=> $carbs, 'fat'=> $fat, 'protein'=> $protein]);

  }
}
