<?php

namespace App\Models\Meals;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = ['food', 'table_id','type', 'image','quantity','weight', 'spoon', 'carbs', 'calories', 'protein','fat','sort','status'];
    public $timestamps = true;
}
