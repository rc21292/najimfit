<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DietInformation;
use DB;

class DietInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diet_informations = DietInformation::latest()->get();

        return view('backend.admin.diets.index',compact('diet_informations'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.diets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('diet_informations')->insert([
            'name' => $request->name,
            'name_arabic' => $request->name_arabic,
            'information' => $request->description,
            'information_arabic' => $request->description_arabic,

        ]);
        return redirect()->route('diet-informations.index');
    }

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
    public function edit($id)
    {
         $diet_informations = DietInformation::find($id);
         // echo "<pre>";print_r($diet_informations);"</pre>";exit;
        return view('backend.admin.diets.edit',compact('diet_informations'));
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
        // echo "<pre>";print_r($request->all());"</pre>";exit;
         DB::table('diet_informations')->where('id',$id)->update([
            'name' => $request->name,
            'name_arabic' => $request->name_arabic,
            'information' => $request->description,
            'information_arabic' => $request->description_arabic,

        ]);
        return redirect()->route('diet-informations.index');
    }

    public function updateInformation(Request $request)
    {
        DB::table('diet_informations')->where('id',$request->cat_id)->update([
            'name' => $request->name,
            'name_arabic' => $request->name_arabic,
            'information' => $request->description,
            'information_arabic' => $request->description_arabic,

        ]);
        return redirect()->route('diet-informations.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = DietInformation::where('id',$id)->delete();
        return redirect()->route('diet-informations.index')
        ->with('warning','Diet Information Deleted successfully');
    }
}
