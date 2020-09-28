<?php

namespace App\Models\Meals;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = ['food', 'table_id','type', 'image', 'carbs', 'calories', 'protein','fat','sort','status'];
    public $timestamps = true;
}
