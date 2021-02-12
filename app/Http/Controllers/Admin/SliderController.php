<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:catalogs']);
        $this->middleware(['permission:gallery']);
    }
    
    public function index()
    {
        $images = Slider::latest()->get();
        return view('backend.admin.slider.index',compact('images'))->with('no',1);
    }


    public function store(Request $request)
    {

        $input = $request->all();
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            // $profileimage = Image::make($file);
            $profileimage = Image::make($file)->resize(1920, 700);
            $profileimage->save(public_path('uploads/slider/'.$path),100);
            $input['image'] = $path;

        }

        Slider::create($input);
        return redirect()->route('slider.index')->with('success','Image Uploaded successfully.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

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
    public function edit(Slider $slider)
    {
        return view('backend.admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            // $profileimage = Image::make($file);
            $profileimage = Image::make($file)->resize(1920, 700);
            $profileimage->save(public_path('uploads/slider/'.$path),100);
            $slider->image = $path;

        }

        $slider->title = $request->title;

        $slider->description = $request->description;

        if(isset($request->title_arabic)){
            $slider->title_arabic = $request->title_arabic;
        }

        if(isset($request->description_arabic)){
            $slider->description_arabic = $request->description_arabic;
        }


        if ($request->has('status')) {

            $slider->status = $request->status;

        }else{

            $slider->status = "off";
        }
        
        $slider->save();

        return redirect()->route('slider.index')->with(['success'=>'Slider Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteimage(Slider $slider)
    {
        $image = public_path('uploads/slider/'.$slider->image);
        File::delete($image);


        $slider->update(['image' => null]);

        return response()->json(["success"=>'deleted']);
    }

    public function destroy($id)
    {
        Slider::find($id)->delete();
        return back()
            ->with('success','Image removed successfully.');    
    }
}
