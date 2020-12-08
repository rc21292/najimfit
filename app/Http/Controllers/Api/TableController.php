<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use App\Models\Package;
use Carbon\Carbon;
use DB;
use Session;
use App\Models\Term;
use File;
use Image;
use App\Models\ClientTable;
use App\Models\Meals\Meal;
use App\Models\Meals\TableCategory;

class TableController extends Controller
{
	public function gettable(Request $request){

		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();

		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			// unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);


			$table->category = TableCategory::find($category)->name;

			$data_breakfast = explode(', ', $breakfast);

			$table_break_fast = [];

			foreach ($data_breakfast as $key => $breakfast) 
			{
				$breakfast_detail =Meal::find($breakfast);
				$table_break_fast[$key]['breakfast_name'] = $breakfast_detail->food;
				if(isset($breakfast_detail->image)){
					$table_break_fast[$key]['breakfast_image'] = 'https://tegdarco.com/uploads/meals/'.$breakfast_detail->image;
				}else{
					$table_break_fast[$key]['breakfast_image'] = 'https://tegdarco.com/uploads/meals/meal.png';
				}
				$table_break_fast[$key]['breakfast_calories'] = $breakfast_detail->calories;
				$table_break_fast[$key]['breakfast_carbs'] = $breakfast_detail->carbs;
				$table_break_fast[$key]['breakfast_protein'] = $breakfast_detail->protein;
				$table_break_fast[$key]['breakfast_fat'] = $breakfast_detail->fat;
				if(isset($breakfast_detail->quantity)){
					$table_break_fast[$key]['breakfast_quantity'] = $breakfast_detail->quantity;
				}

				if(isset($breakfast_detail->weight)){
					$table_break_fast[$key]['breakfast_weight'] = $breakfast_detail->weight.' gm';
				}

				if(isset($breakfast_detail->spoon)){
					$table_break_fast[$key]['breakfast_spoon'] = $breakfast_detail->spoon;
				}
			}

			$table_breakfast_data = [];
			$table_breakfast_calories = 0;
			$i = 0;
			foreach ($table_break_fast as $key1 => $value1) {
				$key1 = $key1+1;
				$table_breakfast_data[$i]['foodDetails']['foodName'] = $value1['breakfast_name'];
				$table_breakfast_data[$i]['foodDetails']['foodCallery'] = $value1['breakfast_calories'];
				$table_breakfast_calories += $value1['breakfast_calories'];
				$i++;
			}

			$data_snacks1 = explode(', ', $snacks1);

			$table_data_snacks1 = [];

			foreach ($data_snacks1 as $key => $snacks1) 
			{

				$snacks1_detail =Meal::find($snacks1);
				$table_data_snacks1[$key]['snacks1_name'] = $snacks1_detail->food;
				if(isset($breakfast_detail->image)){
					$table_data_snacks1[$key]['snacks1_image'] = 'https://tegdarco.com/uploads/meals/'.$snacks1_detail->image;
				}else{
					$table_data_snacks1[$key]['snacks1_image'] = 'https://tegdarco.com/uploads/meals/meal.png';
				}
				$table_data_snacks1[$key]['snacks1_calories'] = $snacks1_detail->calories;
				$table_data_snacks1[$key]['snacks1_carbs'] = $snacks1_detail->carbs;
				$table_data_snacks1[$key]['snacks1_protein'] = $snacks1_detail->protein;
				$table_data_snacks1[$key]['snacks1_fat'] = $snacks1_detail->fat;
				if(isset($snacks1_detail->quantity)){
					$table_data_snacks1[$key]['snacks1_quantity'] = $snacks1_detail->quantity;
				}

				if(isset($snacks1_detail->weight)){
					$table_data_snacks1[$key]['snacks1_weight'] = $snacks1_detail->weight.' gm';
				}

				if(isset($snacks1_detail->spoon)){
					$table_data_snacks1[$key]['snacks1_spoon'] = $snacks1_detail->spoon;
				}
			}

			$table_snacks1 = [];
			$table_snacks1_calories = 0;
			$i = 0;
			foreach ($table_data_snacks1 as $key1 => $value1) {
				$key1 = $key1+1;
				$table_snacks1[$i]['foodDetails']['foodName'] = $value1['snacks1_name'];
				$table_snacks1[$i]['foodDetails']['foodCallery'] = $value1['snacks1_calories'];
				$table_snacks1_calories += $value1['snacks1_calories'];
				$i++;
			}			

			$data_lunch = explode(', ', $lunch);

			$table_data_lunch = [];

			foreach ($data_lunch as $key => $lunch) 
			{
				$lunch_detail =Meal::find($lunch);
				$table_data_lunch[$key]['lunch_name'] = $lunch_detail->food;
				if(isset($lunch_detail->image)){
					$table_data_lunch[$key]['lunch_image'] = 'https://tegdarco.com/uploads/meals/'.$lunch_detail->image;
				}else{
					$table_data_lunch[$key]['lunch_image'] = 'https://tegdarco.com/uploads/meals/meal.png';			
				}
				$table_data_lunch[$key]['lunch_calories'] = $lunch_detail->calories;
				$table_data_lunch[$key]['lunch_carbs'] = $lunch_detail->carbs;
				$table_data_lunch[$key]['lunch_protein'] = $lunch_detail->protein;
				$table_data_lunch[$key]['lunch_fat'] = $lunch_detail->fat;
				if(isset($lunch_detail->quantity)){
					$table_data_lunch[$key]['lunch_quantity'] = $lunch_detail->quantity;
				}

				if(isset($lunch_detail->weight)){
					$table_data_lunch[$key]['lunch_weight'] = $lunch_detail->weight.' gm';
				}

				if(isset($lunch_detail->spoon)){
					$table_data_lunch[$key]['lunch_spoon'] = $lunch_detail->spoon;
				}
			}

			$table_lunch = [];
			$table_lunch_calories = 0;
			$i = 0;
			foreach ($table_data_lunch as $key1 => $value1) {
				$key1 = $key1+1;
				$table_lunch[$i]['foodDetails']['foodName'] = $value1['lunch_name'];
				$table_lunch[$i]['foodDetails']['foodCallery'] = $value1['lunch_calories'];
				$table_lunch_calories += $value1['lunch_calories'];
				$i++;
			}

			$data_snacks2 = explode(', ', $snacks2);

			$table_data_snacks2 = [];

			foreach ($data_snacks2 as $key => $snacks2) 
			{
				$snacks2_detail =Meal::find($snacks2);
				$table_data_snacks2[$key]['snacks2_name'] = $snacks2_detail->food;
				if(isset($snacks2_detail->image)){
					$table_data_snacks2[$key]['snacks2_image'] = 'https://tegdarco.com/uploads/meals/'.$snacks2_detail->image;
				}else{
					$table_data_snacks2[$key]['snacks2_image'] = 'https://tegdarco.com/uploads/meals/meal.png';			
				}
				$table_data_snacks2[$key]['snacks2_calories'] = $snacks2_detail->calories;
				$table_data_snacks2[$key]['snacks2_carbs'] = $snacks2_detail->carbs;
				$table_data_snacks2[$key]['snacks2_protein'] = $snacks2_detail->protein;
				$table_data_snacks2[$key]['snacks2_fat'] = $snacks2_detail->fat;
				if(isset($snacks2_detail->quantity)){
					$table_data_snacks2[$key]['snacks2_quantity'] = $snacks2_detail->quantity;
				}

				if(isset($snacks2_detail->weight)){
					$table_data_snacks2[$key]['snacks2_weight'] = $snacks2_detail->weight.' gm';
				}

				if(isset($snacks2_detail->spoon)){
					$table_data_snacks2[$key]['snacks2_spoon'] = $snacks2_detail->spoon;
				}
			}

			$table_snacks2 = [];
			$table_snacks2_calories = 0;
			foreach ($table_data_snacks2 as $key1 => $value1) {
				$key1 = $key1+1;
				$table_snacks2['food'.$key1]['foodName'] = $value1['snacks2_name'];
				$table_snacks2['food'.$key1]['foodCallery'] = $value1['snacks2_calories'];
				$table_snacks2_calories += $value1['snacks2_calories'];
			}

			$data_dinner = explode(', ', $dinner);

			$table_data_dinner = [];

			foreach ($data_dinner as $key => $dinner) 
			{
				$dinner_detail =Meal::find($dinner);
				$table_data_dinner[$key]['dinner_name'] = $dinner_detail->food;
				if(isset($dinner_detail->image)){
					$table_data_dinner[$key]['dinner_image'] = 'https://tegdarco.com/uploads/meals/'.$dinner_detail->image;
				}else{
					$table_data_dinner[$key]['dinner_image'] = 'https://tegdarco.com/uploads/meals/meal.png';			
				}

				$table_data_dinner[$key]['dinner_calories'] = $dinner_detail->calories;
				$table_data_dinner[$key]['dinner_carbs'] = $dinner_detail->carbs;
				$table_data_dinner[$key]['dinner_protein'] = $dinner_detail->protein;
				$table_data_dinner[$key]['dinner_fat'] = $dinner_detail->fat;
				if(isset($dinner_detail->quantity)){
					$table_data_dinner[$key]['dinner_quantity'] = $dinner_detail->quantity;
				}

				if(isset($dinner_detail->weight)){
					$table_data_dinner[$key]['dinner_weight'] = $dinner_detail->weight.' gm';
				}

				if(isset($dinner_detail->spoon)){
					$table_data_dinner[$key]['dinner_spoon'] = $dinner_detail->spoon;
				}
			}

			$table_dinner = [];
			$table_dinner_calories = 0;
			$i = 0;
			foreach ($table_data_dinner as $key1 => $value1) {
				$key1 = $key1+1;
				$table_dinner[$i]['foodDetails']['foodName'] = $value1['dinner_name'];
				$table_dinner[$i]['foodDetails']['foodCallery'] = $value1['dinner_calories'];
				$table_dinner_calories += $value1['dinner_calories'];
				$i++;
			}

			$data_snacks3 = explode(', ', $snacks3);
			$table_data_snacks3 = [];

			foreach ($data_snacks3 as $key => $snacks3) 
			{
				$snacks3_detail =Meal::find($snacks3);
				$table_data_snacks3[$key]['snacks3_name'] = $snacks3_detail->food;
				if(isset($snacks3_detail->image)){
					$table_data_snacks3[$key]['snacks3_image'] = 'https://tegdarco.com/uploads/meals/'.$snacks3_detail->image;
				}else{
					$table_data_snacks3[$key]['snacks3_image'] = 'https://tegdarco.com/uploads/meals/meal.png';			
				}

				$table_data_snacks3[$key]['snacks3_calories'] = $snacks3_detail->calories;
				$table_data_snacks3[$key]['snacks3_carbs'] = $snacks3_detail->carbs;
				$table_data_snacks3[$key]['snacks3_protein'] = $snacks3_detail->protein;
				$table_data_snacks3[$key]['snacks3_fat'] = $snacks3_detail->fat;
				if(isset($snacks3_detail->quantity)){
					$table_data_snacks3[$key]['snacks3_quantity'] = $snacks3_detail->quantity;
				}

				if(isset($snacks3_detail->weight)){
					$table_data_snacks3[$key]['snacks3_weight'] = $snacks3_detail->weight.' gm';
				}

				if(isset($snacks3_detail->spoon)){
					$table_data_snacks3[$key]['snacks3_spoon'] = $snacks3_detail->spoon;
				}
			}

			$table_snacks3 = [];
			$table_snacks3_calories = 0;
			foreach ($table_data_snacks3 as $key1 => $value1) {
				$key1 = $key1+1;
				$table_snacks3['food'.$key1]['foodName'] = $value1['snacks3_name'];
				$table_snacks3['food'.$key1]['foodCallery'] = $value1['snacks3_calories'];
				$table_snacks3_calories += $value1['snacks3_calories'];
			}

			$table->total_calorie_range = $table->calorie_range;

			unset($table->calorie_range);
			unset($table->table_id);


			$dites = [
				'success' => 'true',
				'diets' => 
				[
					0 => 
					[
						'foodCategory' => 'breakFast',
						'foodcalary' => $table_breakfast_calories,
						'foods' => $table_breakfast_data,
					],
					1 => 
					[
						'foodCategory' => 'lunch',
						'foodcalary' => $table_lunch_calories,
						'foods' => $table_lunch,
					],
					2 => 
					[
						'foodCategory' => 'dinner',
						'foodcalary' => $table_dinner_calories,
						'foods' => $table_dinner,
					],
					3 => 
					[
						'foodCategory' => 'snacks',
						'foodcalary' => $table_snacks1_calories,
						'foods' => $table_snacks1
					],
				],
			];

			return $dites;
			$getlunch = $this->getLunchAPi();
			$getdinner = $this->getDinnerApi();
			$getsnacks = $this->getSnacksApi();
			
			$getbreakfast = $this->getBreakFastApi();
			$getlunch = $this->getLunchAPi();
			$getdinner = $this->getDinnerApi();
			$getsnacks = $this->getSnacksApi();

			return response([
				"success"=>true,
				"diets" => $table,
				"breakfasts" => $getbreakfast,
				"lunchs" => $getlunch,
				"dinners" => $getdinner,
				"snacks" => $getsnacks,
			]);
		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}

	}

	public function getBreakFastApi(){
		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();
		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);


			$table->category = TableCategory::find($category)->name;
			$breakfast_detail =Meal::find($breakfast);
			$table->breakfast_name = $breakfast_detail->food;
			if(isset($breakfast_detail->image)){
				$table->breakfast_image = 'https://tegdarco.com/uploads/meals/'.$breakfast_detail->image;
			}else{
				$table->breakfast_image = 'https://tegdarco.com/uploads/meals/meal.png';
			}
			$table->breakfast_calories = $breakfast_detail->calories;
			$table->breakfast_carbs = $breakfast_detail->carbs;
			$table->breakfast_protein = $breakfast_detail->protein;
			$table->breakfast_fat = $breakfast_detail->fat;
			if(isset($breakfast_detail->quantity)){
				$table->breakfast_quantity = $breakfast_detail->quantity;
			}

			if(isset($breakfast_detail->weight)){
				$table->breakfast_weight = $breakfast_detail->weight.' gm';
			}

			if(isset($breakfast_detail->spoon)){
				$table->breakfast_spoon = $breakfast_detail->spoon;
			}
			unset($table->calorie_range);
			unset($table->table_id);

			return $table;


			return response(["success"=>$table]);
		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}
	}

	public function getbreakfast(){
		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();
		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);


			$table->category = TableCategory::find($category)->name;
			$breakfast_detail =Meal::find($breakfast);
			$table->breakfast_name = $breakfast_detail->food;
			if(isset($breakfast_detail->image)){
				$table->breakfast_image = 'https://tegdarco.com/uploads/meals/'.$breakfast_detail->image;
			}else{
				$table->breakfast_image = 'https://tegdarco.com/uploads/meals/meal.png';
			}
			$table->breakfast_calories = $breakfast_detail->calories;
			$table->breakfast_carbs = $breakfast_detail->carbs;
			$table->breakfast_protein = $breakfast_detail->protein;
			$table->breakfast_fat = $breakfast_detail->fat;
			if(isset($breakfast_detail->quantity)){
				$table->breakfast_quantity = $breakfast_detail->quantity;
			}

			if(isset($breakfast_detail->weight)){
				$table->breakfast_weight = $breakfast_detail->weight.' gm';
			}

			if(isset($breakfast_detail->spoon)){
				$table->breakfast_spoon = $breakfast_detail->spoon;
			}
			unset($table->calorie_range);
			unset($table->table_id);

			return response(["success"=>$table]);
		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}
	}


	public function getLunchAPi(){
		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();
		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);
			$lunch_detail =Meal::find($lunch);
			$table->lunch_name = $lunch_detail->food;
			if(isset($lunch_detail->image)){
				$table->lunch_image = 'https://tegdarco.com/uploads/meals/'.$lunch_detail->image;
			}else{
				$table->lunch_image = 'https://tegdarco.com/uploads/meals/meal.png';			
			}
			$table->lunch_calories = $lunch_detail->calories;
			$table->lunch_carbs = $lunch_detail->carbs;
			$table->lunch_protein = $lunch_detail->protein;
			$table->lunch_fat = $lunch_detail->fat;
			if(isset($lunch_detail->quantity)){
				$table->lunch_quantity = $lunch_detail->quantity;
			}

			if(isset($lunch_detail->weight)){
				$table->lunch_weight = $lunch_detail->weight.' gm';
			}

			if(isset($lunch_detail->spoon)){
				$table->lunch_spoon = $lunch_detail->spoon;
			}
			unset($table->calorie_range);
			unset($table->table_id);

			return $table;


			return response(["success"=>$table]);
		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}
	}

	public function getlunch(){
		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();
		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);
			$lunch_detail =Meal::find($lunch);
			$table->lunch_name = $lunch_detail->food;
			if(isset($lunch_detail->image)){
				$table->lunch_image = 'https://tegdarco.com/uploads/meals/'.$lunch_detail->image;
			}else{
				$table->lunch_image = 'https://tegdarco.com/uploads/meals/meal.png';			
			}
			$table->lunch_calories = $lunch_detail->calories;
			$table->lunch_carbs = $lunch_detail->carbs;
			$table->lunch_protein = $lunch_detail->protein;
			$table->lunch_fat = $lunch_detail->fat;
			if(isset($lunch_detail->quantity)){
				$table->lunch_quantity = $lunch_detail->quantity;
			}

			if(isset($lunch_detail->weight)){
				$table->lunch_weight = $lunch_detail->weight.' gm';
			}

			if(isset($lunch_detail->spoon)){
				$table->lunch_spoon = $lunch_detail->spoon;
			}
			unset($table->calorie_range);
			unset($table->table_id);

			return response(["success"=>$table]);
		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}
	}

	public function getDinnerApi(){
		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();
		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);

			$dinner_detail =Meal::find($dinner);
			$table->dinner_name = $dinner_detail->food;
			if(isset($dinner_detail->image)){
				$table->dinner_image = 'https://tegdarco.com/uploads/meals/'.$dinner_detail->image;
			}else{
				$table->dinner_image = 'https://tegdarco.com/uploads/meals/meal.png';			
			}

			$table->dinner_calories = $dinner_detail->calories;
			$table->dinner_carbs = $dinner_detail->carbs;
			$table->dinner_protein = $dinner_detail->protein;
			$table->dinner_fat = $dinner_detail->fat;
			if(isset($dinner_detail->quantity)){
				$table->dinner_quantity = $dinner_detail->quantity;
			}

			if(isset($dinner_detail->weight)){
				$table->dinner_weight = $dinner_detail->weight.' gm';
			}

			if(isset($dinner_detail->spoon)){
				$table->dinner_spoon = $dinner_detail->spoon;
			}
			unset($table->calorie_range);
			unset($table->table_id);

			return $table;


			return response(["success"=>$table]);

		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}
	}

	public function getdinner(){
		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();
		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);

			$dinner_detail =Meal::find($dinner);
			$table->dinner_name = $dinner_detail->food;
			if(isset($dinner_detail->image)){
				$table->dinner_image = 'https://tegdarco.com/uploads/meals/'.$dinner_detail->image;
			}else{
				$table->dinner_image = 'https://tegdarco.com/uploads/meals/meal.png';			
			}

			$table->dinner_calories = $dinner_detail->calories;
			$table->dinner_carbs = $dinner_detail->carbs;
			$table->dinner_protein = $dinner_detail->protein;
			$table->dinner_fat = $dinner_detail->fat;
			if(isset($dinner_detail->quantity)){
				$table->dinner_quantity = $dinner_detail->quantity;
			}

			if(isset($dinner_detail->weight)){
				$table->dinner_weight = $dinner_detail->weight.' gm';
			}

			if(isset($dinner_detail->spoon)){
				$table->dinner_spoon = $dinner_detail->spoon;
			}
			unset($table->calorie_range);
			unset($table->table_id);

			return response(["success"=>$table]);

		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}
	}

	public function getSnacksApi(){

		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();
		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);

			$snacks1_detail =Meal::find($snacks1);
			$table->snacks1_name = $snacks1_detail->food;
			if(isset($breakfast_detail->image)){
				$table->snacks1_image = 'https://tegdarco.com/uploads/meals/'.$snacks1_detail->image;
			}else{
				$table->snacks1_image = 'https://tegdarco.com/uploads/meals/meal.png';
			}
			$table->snacks1_calories = $snacks1_detail->calories;
			$table->snacks1_carbs = $snacks1_detail->carbs;
			$table->snacks1_protein = $snacks1_detail->protein;
			$table->snacks1_fat = $snacks1_detail->fat;
			if(isset($snacks1_detail->quantity)){
				$table->snacks1_quantity = $snacks1_detail->quantity;
			}

			if(isset($snacks1_detail->weight)){
				$table->snacks1_weight = $snacks1_detail->weight.' gm';
			}

			if(isset($snacks1_detail->spoon)){
				$table->snacks1_spoon = $snacks1_detail->spoon;
			}
			$snacks2_detail =Meal::find($snacks2);
			$table->snacks2_name = $snacks2_detail->food;
			if(isset($snacks2_detail->image)){
				$table->snacks2_image = 'https://tegdarco.com/uploads/meals/'.$snacks2_detail->image;
			}else{
				$table->snacks2_image = 'https://tegdarco.com/uploads/meals/meal.png';			
			}
			$table->snacks2_calories = $snacks2_detail->calories;
			$table->snacks2_carbs = $snacks2_detail->carbs;
			$table->snacks2_protein = $snacks2_detail->protein;
			$table->snacks2_fat = $snacks2_detail->fat;
			if(isset($snacks2_detail->quantity)){
				$table->snacks2_quantity = $snacks2_detail->quantity;
			}

			if(isset($snacks2_detail->weight)){
				$table->snacks2_weight = $snacks2_detail->weight.' gm';
			}

			if(isset($snacks2_detail->spoon)){
				$table->snacks2_spoon = $snacks2_detail->spoon;
			}
			$snacks3_detail =Meal::find($snacks3);
			$table->snacks3_name = $snacks3_detail->food;
			if(isset($snacks3_detail->image)){
				$table->snacks3_image = 'https://tegdarco.com/uploads/meals/'.$snacks3_detail->image;
			}else{
				$table->snacks3_image = 'https://tegdarco.com/uploads/meals/meal.png';			
			}

			$table->snacks3_calories = $snacks3_detail->calories;
			$table->snacks3_carbs = $snacks3_detail->carbs;
			$table->snacks3_protein = $snacks3_detail->protein;
			$table->snacks3_fat = $snacks3_detail->fat;
			if(isset($snacks3_detail->quantity)){
				$table->snacks3_quantity = $snacks3_detail->quantity;
			}

			if(isset($snacks3_detail->weight)){
				$table->snacks3_weight = $snacks3_detail->weight.' gm';
			}

			if(isset($snacks3_detail->spoon)){
				$table->snacks3_spoon = $snacks3_detail->spoon;
			}
			unset($table->calorie_range);
			unset($table->table_id);

			return $table;

			return response(["success"=>$table]);
		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}
		
	}

	public function getsnacks(){

		$client_id = Auth::id();

		$table = ClientTable::where('client_id',$client_id)->first();
		if(isset($table)){

			$category = $table->table_id ;
			$breakfast= $table->breakfast;
			$snacks1= $table->snacks1;
			$lunch= $table->lunch;
			$snacks2= $table->snacks2;
			$dinner= $table->dinner;
			$snacks3= $table->snacks3;
			unset($table->breakfast);
			unset($table->snacks1);
			unset($table->lunch);
			unset($table->snacks2);
			unset($table->dinner);
			unset($table->snacks3);
			unset($table->calories);
			unset($table->carbs);
			unset($table->protein);
			unset($table->fat);
			unset($table->created_at);
			unset($table->updated_at);

			$snacks1_detail =Meal::find($snacks1);
			$table->snacks1_name = $snacks1_detail->food;
			if(isset($breakfast_detail->image)){
				$table->snacks1_image = 'https://tegdarco.com/uploads/meals/'.$snacks1_detail->image;
			}else{
				$table->snacks1_image = 'https://tegdarco.com/uploads/meals/meal.png';
			}
			$table->snacks1_calories = $snacks1_detail->calories;
			$table->snacks1_carbs = $snacks1_detail->carbs;
			$table->snacks1_protein = $snacks1_detail->protein;
			$table->snacks1_fat = $snacks1_detail->fat;
			if(isset($snacks1_detail->quantity)){
				$table->snacks1_quantity = $snacks1_detail->quantity;
			}

			if(isset($snacks1_detail->weight)){
				$table->snacks1_weight = $snacks1_detail->weight.' gm';
			}

			if(isset($snacks1_detail->spoon)){
				$table->snacks1_spoon = $snacks1_detail->spoon;
			}
			$snacks2_detail =Meal::find($snacks2);
			$table->snacks2_name = $snacks2_detail->food;
			if(isset($snacks2_detail->image)){
				$table->snacks2_image = 'https://tegdarco.com/uploads/meals/'.$snacks2_detail->image;
			}else{
				$table->snacks2_image = 'https://tegdarco.com/uploads/meals/meal.png';			
			}
			$table->snacks2_calories = $snacks2_detail->calories;
			$table->snacks2_carbs = $snacks2_detail->carbs;
			$table->snacks2_protein = $snacks2_detail->protein;
			$table->snacks2_fat = $snacks2_detail->fat;
			if(isset($snacks2_detail->quantity)){
				$table->snacks2_quantity = $snacks2_detail->quantity;
			}

			if(isset($snacks2_detail->weight)){
				$table->snacks2_weight = $snacks2_detail->weight.' gm';
			}

			if(isset($snacks2_detail->spoon)){
				$table->snacks2_spoon = $snacks2_detail->spoon;
			}
			$snacks3_detail =Meal::find($snacks3);
			$table->snacks3_name = $snacks3_detail->food;
			if(isset($snacks3_detail->image)){
				$table->snacks3_image = 'https://tegdarco.com/uploads/meals/'.$snacks3_detail->image;
			}else{
				$table->snacks3_image = 'https://tegdarco.com/uploads/meals/meal.png';			
			}

			$table->snacks3_calories = $snacks3_detail->calories;
			$table->snacks3_carbs = $snacks3_detail->carbs;
			$table->snacks3_protein = $snacks3_detail->protein;
			$table->snacks3_fat = $snacks3_detail->fat;
			if(isset($snacks3_detail->quantity)){
				$table->snacks3_quantity = $snacks3_detail->quantity;
			}

			if(isset($snacks3_detail->weight)){
				$table->snacks3_weight = $snacks3_detail->weight.' gm';
			}

			if(isset($snacks3_detail->spoon)){
				$table->snacks3_spoon = $snacks3_detail->spoon;
			}
			unset($table->calorie_range);
			unset($table->table_id);

			return response(["success"=>$table]);
		}else{
			return response(['errors'=>'Diet not assigned by Nutrionist'], 422);
		}
		
	}
}
