<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = QuestionCategory::all();
        return view('backend.admin.features.questions.category',compact('categories'))->with('no', 1);
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
        QuestionCategory::create($request->all());

        return back()->with(['success'=>'Question Category Saved Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkoutCategory  $workoutCategory
     * @return \Illuminate\Http\Response
     */
    public function show(WorkoutCategory $workoutCategory)
    {

    
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
        $category = QuestionCategory::findOrFail($request->category_id);

        $category->update($request->all());
       
       
        return back()->with(['success'=>'Question Category Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkoutCategory  $workoutCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionCategory $QuestionCategory)
    {
        $QuestionCategory->delete();

        return back()->with(['warning'=>'Question Category Deleted Successfully!']);
    }
}
