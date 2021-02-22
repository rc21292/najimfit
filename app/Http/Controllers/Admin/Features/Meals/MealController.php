<?php

namespace App\Http\Controllers\Admin\Features\Meals;
use File;
use Image;
use App\Http\Controllers\Controller;
use App\Models\Meals\Meal;
use App\Models\Meals\TableCategory;
use Illuminate\Http\Request;

class MealController extends Controller
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
      $tables = TableCategory::all();   
      return view('backend.admin.features.tables.create',compact('tables'));
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
            $destinationPath = public_path().'/uploads/meals/';
            $file->move($destinationPath,$file->getClientOriginalName());

        }

        $meal = new Meal;
        $meal->food = $request->food;
        $meal->food_arabic = $request->food_arabic;
        $meal->table_id = $request->table;
        $meal->type = $request->type;
        if(isset($request->quantity)){
           $meal->quantity = $request->quantity;
        }
        if(isset($request->weight)){
           $meal->weight = $request->weight;
        }
        if(isset($request->spoon)){
           $meal->spoon = $request->spoon;
        }
       $meal->calories = $request->calories;
       $meal->carbs = $request->carbs;
       $meal->fat = $request->fat;
       $meal->protein = $request->protein;
       $meal->sort = $request->sort;
       if(isset($name)){
        $meal->image = $name;
    }
    if ($request->has('status')) {

        $meal->status = $request->status;

    }else{

        $meal->status = "off";
    }

    $meal->save();
    return redirect()->route('meals.show',$request->table)->with(['success'=>'Meal Saved Successfully!']);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meals\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $meals = Meal::where('table_id',$id)->get();   
       return view('backend.admin.features.tables.index',compact('meals'))->with('no', 1);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meals\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tables = TableCategory::all();  
        $meal = Meal::find($id);
        return view('backend.admin.features.tables.edit',compact('meal','tables'))->with('no', 1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meals\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        if ($request->has('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/meals/';
            $file->move($destinationPath,$file->getClientOriginalName());

        }

        $meal->food = $request->food;
        $meal->food_arabic = $request->food_arabic;
        $meal->table_id = $request->table;
        $meal->type = $request->type;
        if(isset($request->quantity)){
           $meal->quantity = $request->quantity;
        }
        if(isset($request->weight)){
           $meal->weight = $request->weight;
        }
        if(isset($request->spoon)){
           $meal->spoon = $request->spoon;
        }
        $meal->calories = $request->calories;
        $meal->carbs = $request->carbs;
        $meal->fat = $request->fat;
        $meal->protein = $request->protein;
        $meal->sort = $request->sort;
        if ($request->has('image')) {
            $meal->image = $name;
        }
        if ($request->has('status')) {

            $meal->status = $request->status;

        }else{

            $meal->status = "off";
        }

        $meal->save();
        return redirect()->route('meals.show',$request->table)->with(['success'=>'Meal Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meals\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal = Meal::find($id)->first();
        $image = public_path('uploads/meals/'.$meal->image);
        File::delete($image);
        $meal->delete();
        return redirect()->route('meals.show',$meal->table_id)->with(['warning'=>'Meal Deleted Successfully!']);
    }

    public function deleteimage(Meal $meal)
    {
        $image = public_path('uploads/meals/'.$meal->image);
        File::delete($image);
        $meal->update(['image' => null]);
        return response()->json(["success"=>'deleted']);
    }

    public function massDelete(Request $request)
    {   
        $ids = $request->ids;
        Meal::whereIn('id',explode(",",$ids))->delete();

        return redirect()->route('meals.show',2)->with(['warning'=>'Meal Deleted Successfully!']);
    }
}
