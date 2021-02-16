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
        $user = User::find($user_id);
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file)->resize(180, 180);
            $profileimage->save(public_path('uploads/user/'.$path),100);

        }

        if ($request->has('image')) {
            $user->avatar = $path;
        }

        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file);
            $profileimage->save(public_path('uploads/user/dashboard/'.$path),100);
            $user->image = $path;

        }
        
        //Save Category in Database

        
        $user->name = $request->name;
        if(isset($request->description)){
            $user->description = $request->description;
        }
        if(isset($request->description_arabic)){
            $user->description_arabic = $request->description_arabic;
        }

        if(isset($request->tagline)){
            $user->tagline = $request->tagline;
        }
        if(isset($request->tagline_arabic)){
            $user->tagline_arabic = $request->tagline_arabic;
        }

        $user->facebook_link = $request->facebook_link;
        $user->twitter_link = $request->twitter_link;
        $user->instagarm_link = $request->instagarm_link;
        $user->youtube_link = $request->youtube_link;
        
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

    public function deleteimage($id){
        $image = public_path('uploads/user/'.Auth::User()->avatar);
        File::delete($image);
        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $user->avatar = Null;
        $user->save();
        return response()->json(["success"=>'deleted']);
    }
}
