<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use File;
use Image;
use Session;
use Illuminate\Http\Request;


class MyProfileController extends Controller
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
    public function index(){
        $user_id = Auth::User()->id;
        $profile = User::find($user_id);
        return view('backend.admin.myprofile',compact('profile'));
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
        $user_id = Auth::User()->id;
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file)->resize(180, 180);
            $profileimage->save(public_path('uploads/user/'.$path),100);

        }
        
        //Save Category in Database

        $user = User::find($user_id);
        $user->name = $request->name;
        if ($request->has('image')) {
            $user->avatar = $path;
        }
     $user->save();

     return redirect()->route('my-account.index')->with(['success'=>'Saved Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function deleteimage($avater){
        $image = public_path('uploads/user/'.$avater);
        File::delete($image);
        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $user->avatar = null;
        $user->save();
        return response()->json(["success"=>'deleted']);
    }
}
