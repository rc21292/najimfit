<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        DB::table('client_labels')->where('client_id',$request->client_id)->delete();
        foreach($request->labels as $key => $label){
            DB::table('client_labels')->insert([
                'client_id'=>$request->client_id,
                'label'=> $label,
            ]);
        }
        if(isset($request->customized_lable)){
        DB::table('client_labels')->insert([
                'client_id'=>$request->client_id,
                'label'=> $request->customized_lable,
        ]);
        }
        return redirect()->to(Session::get('back_lables_url'))->with('success','Labels Saved successfully');
        return redirect()->back()->with('success','Labels Saved successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $labels = DB::table('client_labels')->where('client_id',$id)->get();
        return view('backend.admin.clients.label',compact('labels','id'));
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
        //
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
