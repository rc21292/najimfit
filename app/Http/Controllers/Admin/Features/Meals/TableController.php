<?php

namespace App\Http\Controllers\Admin\Features\Meals;

use App\Http\Controllers\Controller;
use App\Models\Meals\TableCategory;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware(['permission:add-features']);
        $this->middleware(['permission:new-tables']);  
        
    }

    public function index()
    {
        $categories = TableCategory::all();
        return view('backend.admin.features.tables.category',compact('categories'))->with('no', 1);
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
        TableCategory::create($request->all());

        return back()->with(['success'=>'Table Category Saved Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meals\TableCategory  $tableCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TableCategory $tableCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meals\TableCategory  $tableCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TableCategory $tableCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meals\TableCategory  $tableCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TableCategory $tableCategory)
    {
       $category = TableCategory::findOrFail($request->category_id);

       $category->update($request->all());
       
       
       return back()->with(['success'=>'Table Category Updated Successfully!']);
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meals\TableCategory  $tableCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableCategory $tableCategory)
    {
        $tableCategory->delete();

        return back()->with(['warning'=>'Table Category Deleted Successfully!']);
    }
}
