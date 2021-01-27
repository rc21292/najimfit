<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Image;
use File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Gallery::latest()->get();
        return view('backend.admin.gallery.index',compact('images'))->with('no',1);
    }


    public function store(Request $request)
    {

        $input = $request->all();
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file);
            $profileimage->save(public_path('uploads/gallery/'.$path),100);
            $input['image'] = $path;

        }
        Gallery::create($input);
        return redirect()->route('gallery.index')->with('success','Image Uploaded successfully.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.gallery.create');
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
    public function edit(Gallery $gallery)
    {
        return view('backend.admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        if ($request->has('image')) {

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = time().$name;
            $profileimage = Image::make($file);
            // $profileimage = Image::make($file)->resize(553, 285);
            $profileimage->save(public_path('uploads/gallery/'.$path),100);

        }
        if ($request->has('image')) {
            $gallery->image = $path;
        }
        $gallery->title = $request->title;

        $gallery->description = $request->description;

        if(isset($request->title_arabic)){
            $gallery->title_arabic = $request->title_arabic;
        }

        if(isset($request->description_arabic)){
            $gallery->description_arabic = $request->description_arabic;
        }


        if ($request->has('status')) {

            $gallery->status = $request->status;

        }else{

            $gallery->status = "off";
        }
        
        $gallery->save();

        return redirect()->route('gallery.index')->with(['success'=>'Gallery Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteimage(Gallery $gallery)
    {
        $image = public_path('uploads/gallery/'.$gallery->image);
        File::delete($image);
        $gallery->update(['image' => null]);
        return response()->json(["success"=>'deleted']);
    }

    public function destroy($id)
    {
        Gallery::find($id)->delete();
        return back()
            ->with('success','Image removed successfully.');    
    }
}
