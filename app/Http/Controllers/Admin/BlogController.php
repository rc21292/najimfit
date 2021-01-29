<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Image;
use File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $images = Blog::all();
        return view('backend.admin.blogs.index',compact('images'))->with('no',1);
    }


    public function store(Request $request)
    {

        $input = $request->all();
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            // $profileimage = Image::make($file);
            $profileimage = Image::make($file);
            $profileimage->save(public_path('uploads/blogs/'.$path),100);
            $input['image'] = $path;

        }

        Blog::create($input);
        return redirect()->route('blogs.index')->with('success','Image Uploaded successfully.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.blogs.create');
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
    public function edit(Blog $blog)
    {
        return view('backend.admin.blogs.edit', compact('blog'));
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
        $blogs = Blog::find($id);
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            // $profileimage = Image::make($file);
            $profileimage = Image::make($file);
            $profileimage->save(public_path('uploads/blogs/'.$path),100);
            $blogs->image = $path;

        }

        $blogs->title = $request->title;

        $blogs->description = $request->description;

        if(isset($request->title_arabic)){
            $blogs->title_arabic = $request->title_arabic;
        }

        if(isset($request->description_arabic)){
            $blogs->description_arabic = $request->description_arabic;
        }


        if ($request->has('status')) {

            $blogs->status = $request->status;

        }else{

            $blogs->status = "off";
        }
        
        $blogs->save();

        return redirect()->route('blogs.index')->with(['success'=>'Blog Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteimage($id)
    {
        $blogs = Blog::find($id);
        $image = public_path('uploads/blogs/'.$blogs->image);
        File::delete($image);
        $blogs->update(['image' => null]);

        return response()->json(["success"=>'deleted']);
    }

    public function destroy($id)
    {
        Blog::find($id)->delete();
        return back()
            ->with('success','Image removed successfully.');    
    }
}
