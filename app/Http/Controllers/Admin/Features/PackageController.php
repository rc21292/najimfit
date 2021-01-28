<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use File;
use Image;
use Session;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('backend.admin.features.packages.index',compact('packages'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.features.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file)->resize(553, 285);
            $profileimage->save(public_path('uploads/packages/'.$path),100);
            $input['image'] = $path;

        }

        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file);
            $profileimage->save(public_path('uploads/packages/dashboard/'.$path),100);
            $input['image_full'] = $path;

        }

        if ($request->has('image_popup')) {

            $file = $request->file('image_popup');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file);
            $profileimage->save(public_path('uploads/packages/dashboard/popup/'.$path),100);
            $input['image_popup'] = $path;

        }

        $workout_days = @implode(',', $request->workout_days);

        $str_arr = @explode (",", $workout_days); 

        $arr1 = array(1,2,3,4,5,6,7); 

        $arr2 = $str_arr; 

        $missing = array_diff($arr1,$arr2);

        $strinarr = @implode(',', $missing);

        $input['workout_days'] = $workout_days;
        $input['off_days'] = $strinarr;

        $new_package = Package::create($input);
        return redirect()->route('package.index')->with(['success'=>'Package Saved Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $package->workout_days = explode(',', $package->workout_days);
        return view('backend.admin.features.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file)->resize(553, 285);
            $profileimage->save(public_path('uploads/packages/'.$path),100);
            $package->image = $path;

        }

        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file);
            $profileimage->save(public_path('uploads/packages/dashboard/'.$path),100);
            $package->image_full = $path;

        }


        if ($request->has('image_popup')) {

            $file = $request->file('image_popup');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file);
            $profileimage->save(public_path('uploads/packages/dashboard/popup/'.$path),100);
            $package->image_popup = $path;

        }

        $package->name = $request->name;
        $package->type = $request->type;
        $package->includes = $request->includes;

        $package->sort = $request->sort;

        $package->price = $request->price;

        $package->validity = $request->validity;
        
        $workout_days = @implode(',', $request->workout_days);

        $str_arr = @explode(",", $workout_days); 

        $arr1 = array(1,2,3,4,5,6,7); 

        $arr2 = $str_arr; 

        $missing = array_diff($arr1,$arr2);

        $strinarr = @implode(',', $missing);

        $package->off_days = $strinarr;

        $package->workout_days = $workout_days;

        $package->target = $request->target;

        $package->description = $request->description;

        if(isset($request->description)){
            $package->name_arabic = $request->name_arabic;
        }
        if(isset($request->target_arabic)){
            $package->target_arabic = $request->target_arabic;
        }
        if(isset($request->description_arabic)){
            $package->description_arabic = $request->description_arabic;
        }


        if ($request->has('status')) {

            $package->status = $request->status;

        }else{

            $package->status = "off";
        }
        
        $package->save();

        return redirect()->route('package.index')->with(['success'=>'Package Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('package.index')->with(['warning'=>'Package Deleted Successfully!']);
    }

    public function deleteimage(Package $package)
    {
        $image = public_path('uploads/packages/'.$package->image);
        File::delete($image);
        $package->update(['image' => null]);
        return response()->json(["success"=>'deleted']);
    }
}
