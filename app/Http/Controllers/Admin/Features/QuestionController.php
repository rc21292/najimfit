<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('backend.admin.features.questions.index',compact('questions'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last_record = Question::orderBy('sort', 'desc')->first();
        $sort = $last_record->sort + 1;
        $categories = QuestionCategory::all();
        return view('backend.admin.features.questions.create',compact('sort','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/questions/';
            $file->move($destinationPath,$file->getClientOriginalName());

        }
        $question = new Question;
        if ($request->has('image')) {
            $question->image = $name;
        }
        if (isset($request->unit)) {
            $question->unit = $request->unit;
        }
        $question->category = $request->category;
        $question->gender = $request->gender;
        $question->sort = $request->sort;
        $question->question = $request->question;
        if(isset($request->question_arabic)){
        $question->question_arabic = $request->question_arabic;
        }
        $question->save();
        return redirect()->route('question.index')->with(['success'=>'Question Saved Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $categories = QuestionCategory::all();
        return view('backend.admin.features.questions.edit', compact('question','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        if ($request->has('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/questions/';
            $file->move($destinationPath,$file->getClientOriginalName());

        }
        if ($request->has('image')) {
            $question->image = $name;
        }
        if (isset($request->unit)) {
            $question->unit = $request->unit;
        }
        $question->category = $request->category;
        $question->gender = $request->gender;
        $question->sort = $request->sort;
        $question->question = $request->question;
        if(isset($request->question_arabic)){
        $question->question_arabic = $request->question_arabic;
        }
        $question->save();
        return redirect()->route('question.index')->with(['success'=>'Question Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('question.index')->with(['warning'=>'Question Deleted Successfully!']);
    }

    public function deleteimage(Question $question)
    {
        $image = public_path('uploads/questions/'.$question->image);
        File::delete($image);
        $question->update(['image' => null]);
        return response()->json(["success"=>'deleted']);
    }
}
