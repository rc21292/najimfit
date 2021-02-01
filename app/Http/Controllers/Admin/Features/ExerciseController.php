<?php 

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use DB;
use File;
use Image;
use App\Models\Exercise;
use App\Models\WorkoutCategory;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware(['permission:add-features']);
        $this->middleware(['permission:new-workouts']);
    }
    
    public function index()
    {
        $exercises = DB::table('exercises')->join('workout_categories','workout_categories.id','=','exercises.category')->select('exercises.*','workout_categories.name as category')->get();

        return view('backend.admin.features.workouts.index',compact('exercises'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = WorkoutCategory::all();
        $last_record = Exercise::orderBy('sort', 'desc')->first();
        if(isset($last_record)){
            $sort = $last_record->sort + 1;
        }else{

            $sort = 1;
        }
        return view('backend.admin.features.workouts.create',compact('sort','categories'));
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
            $destinationPath = public_path().'/uploads/exercises/';
            $file->move($destinationPath,$file->getClientOriginalName());

        }

        $exercise = new Exercise;
        $exercise->name = $request->name;
        $exercise->name_arabic = $request->name_arabic;
        $exercise->category = $request->category;
        $exercise->sort = $request->sort;
        $exercise->image = $name;
        if ($request->has('video')) {
            $exercise->video = $request->video;
        }
        $exercise->time = $request->time;
        $exercise->calories = $request->calories;
        $exercise->description = $request->description;
        $exercise->description_arabic = $request->description_arabic;

        $exercise->save();
        return redirect()->route('exercise.index')->with(['success'=>'Exercise Saved Successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */

    public function show(Exercise $exercise)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exercise = Exercise::find($id);
        $categories = WorkoutCategory::all();
        return view('backend.admin.features.workouts.edit',compact('exercise','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        if ($request->has('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/exercises/';
            $file->move($destinationPath,$file->getClientOriginalName());

        }

        $exercise->name = $request->name;
        $exercise->name_arabic = $request->name_arabic;
        $exercise->description_arabic = $request->description_arabic;
        $exercise->category = $request->category;
        $exercise->sort = $request->sort;
        if ($request->has('image')) {
            $exercise->image = $name;
        }
        if ($request->has('video')) {
            $exercise->video = $request->video;
        }
        $exercise->time = $request->time;
        $exercise->calories = $request->calories;
        $exercise->description = $request->description;

        $exercise->save();
        return redirect()->route('exercise.index')->with(['success'=>'Exercise Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exercise = Exercise::find($id);
        $image = public_path('uploads/exercises/'.$exercise->image);
        File::delete($image);
        $exercise->delete();
        return redirect()->route('exercise.index')->with(['warning'=>'Exercise Deleted Successfully!']);
    }

    public function deleteimage(Exercise $exercise)
    {
        $image = public_path('uploads/exercises/'.$exercise->image);
        File::delete($image);
        $exercise->update(['image' => null]);
        return response()->json(["success"=>'deleted']);
    }
    public function storeinformation(Request $request){
        DB::table('workout_information')->insert([
            'name' => $request->name,
            'name_arabic' => $request->name_arabic,
            'information' => $request->description,
            'information_arabic' => $request->description_arabic,

        ]);
        return redirect()->route('workout-informations');
    }      

    public function updateinformation(Request $request){
       DB::table('workout_information')->where('id',$request->cat_id)->update([
        'name' => $request->name,
        'name_arabic' => $request->name_arabic,
        'information' => $request->description,
        'information_arabic' => $request->description_arabic,

    ]);
       return redirect()->route('workout-informations');

   }
   public function getworkoutinformation(){
    $categories = DB::table('workout_information')->get();

    return view('backend.admin.features.workouts.information',compact('categories'))->with('no', 1);
}
}
