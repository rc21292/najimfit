<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientTable;
use App\Models\Question;
use App\Models\Meals\TableCategory;
use App\Models\Meals\Meal;
use App\Models\Package;
use DB;

class ClientProfileController extends Controller
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
        $profile = Client::find($id);
        $answers = DB::table('client_answers')->join('questions','questions.id','=','client_answers.question_id')->select('questions.question','client_answers.answer')->where('client_answers.client_id',$id)->get();
        $client = Client::find($id);
        $weight = DB::table('client_answers')->where('client_id',$id)->where('question_id',9)->value('answer');
        $height = DB::table('client_answers')->where('client_id',$id)->where('question_id',10)->value('answer');
        // $table_id = ClientTable::where('client_id',$id)->value('table_id');
        // $table = TableCategory::find($table_id)->name;
        // $selected_meal = ClientTable::where('client_id',$id)->first();
        // $breakfast = Meal::where('id',$selected_meal->breakfast)->first();
        // $lunch = Meal::where('id',$selected_meal->lunch)->first();
        // $dinner = Meal::where('id',$selected_meal->dinner)->first();
        // $snacks1 = Meal::where('id',$selected_meal->snacks1)->first();
        // $snacks2 = Meal::where('id',$selected_meal->snacks2)->first();
        // $snacks3 = Meal::where('id',$selected_meal->snacks3)->first();
        $client_package = Package::find($client->package_id)->first();


        return view('backend.admin.clients.view_full_profile',compact('profile','answers','client','weight','height','client_package'));
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
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file)->resize(180, 180);
            $profileimage->save(public_path('uploads/user/'.$path),100);

        }
        
        //Update  Client in Database

        $client = Client::find($id);
        $client->firstname = $request->firstname;
        $client->lastname = $request->lastname;
        $client->gender = $request->gender;
        $client->email = $request->email;
        if ($request->has('image')) {
            $client->avater = $path;
        }
    
        $client->save();

     return redirect()->route('client-full-profile.show',$id)->with(['success'=>'Profile Saved Successfully!']);
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
