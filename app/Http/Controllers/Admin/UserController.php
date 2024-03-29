<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class UserController extends Controller
{
  function __construct()
  {
    $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
    $this->middleware('permission:user-create', ['only' => ['create','store']]);
    $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:user-delete', ['only' => ['destroy']]);
  }
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
  $data = User::orderBy('id','DESC')->paginate(5);

  return view('backend.admin.users.index',compact('data'))
  ->with('i', ($request->input('page', 1) - 1) * 5);
}

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    *
    */

    public function create()
    {
      $roles = Role::pluck('name','name')->all();
      $nutritionists = User::role('Nutritionist')->get(['id','name']);

      return view('backend.admin.users.create',compact('roles', 'nutritionists'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    *
    */

    public function store(Request $request)
    {
      $this->validate($request, [
       'name' => 'required',
       'email' => 'required|email|unique:users,email',
       'password' => 'required|same:confirm-password',
       'roles' => 'required'
     ]);

      $input = $request->all();
      $input['password'] = Hash::make($input['password']);
      $user = User::create($input);
      DB::table('users')->where('id',$user->id)->update(['nutritionist_id'=>'NJMF'.$user->id]);
      $user->assignRole($request->input('roles'));
      if($request->has('nutritionists') && !empty($request->nutritionists)){
        foreach($request->nutritionists as $nutritionist){
          DB::table('admin_nutritionist')->insert([
            'admin_id' => $user->id,
            'nutritionist_id' => $nutritionist
          ]);
        }
      }
      return redirect()->route('users.index')
      ->with('success','User created successfully');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show($id)
    {
      $user = User::find($id);

      return view('backend.admin.users.show',compact('user'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
      $user = User::find($id);
      $roles = Role::pluck('name','name')->all();
      $userRole = $user->roles->pluck('name','name')->all();
      $nutritionists = User::role('Nutritionist')->get(['id','name']);
      $selected_nutritionist = DB::table('admin_nutritionist')->where('admin_id', $id)->pluck('nutritionist_id')->toArray();
      return view('backend.admin.users.edit',compact('user','roles','userRole','nutritionists','selected_nutritionist'));
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

      $this->validate($request, [
       'name' => 'required',
       'email' => 'required|email|unique:users,email,'.$id,
       'password' => 'same:confirm-password',
       'roles' => 'required'
     ]);

      $input = $request->all();


      if(!empty($input['password'])){
       $input['password'] = Hash::make($input['password']);
     }else{

      $input = $request->except('password','confirm-password');
       // $input = @array_except($input,array('password'));


    }

    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id',$id)->delete();
    $user->assignRole($request->input('roles'));
    if($request->has('nutritionists') && !empty($request->nutritionists)){
       DB::table('admin_nutritionist')->where('admin_id', $id)->delete();
      foreach($request->nutritionists as $nutritionist){
        DB::table('admin_nutritionist')->insert([
          'admin_id' => $id,
          'nutritionist_id' => $nutritionist
        ]);
      }
    }
    return redirect()->route('users.index')
    ->with('success','User updated successfully');
  }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy($id)
    {
      User::find($id)->delete();
      return redirect()->route('users.index')
      ->with('success','User deleted successfully');
    }
  }