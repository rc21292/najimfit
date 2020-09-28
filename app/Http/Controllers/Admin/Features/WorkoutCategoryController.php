<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use App\Models\WorkoutCategory;
use Illuminate\Http\Request;

class WorkoutCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = WorkoutCategory::all();
        return view('backend.admin.features.workouts.category',compact('categories'))->with('no', 1);
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
        WorkoutCategory::create($request->all());

        return back()->with(['success'=>'Workout Category Saved Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkoutCategory  $workoutCategory
     * @return \Illuminate\Http\Response
     */
    public function show(WorkoutCategory $workoutCategory)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkoutCategory  $workoutCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkoutCategory $workoutCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkoutCategory  $workoutCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category = WorkoutCategory::findOrFail($request->category_id);

        $category->update($request->all());
       
       
        return back()->with(['success'=>'Workout Category Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkoutCategory  $workoutCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkoutCategory $workoutCategory)
    {
        $workoutCategory->delete();

        return back()->with(['warning'=>'Workout Category Deleted Successfully!']);
    }
}
