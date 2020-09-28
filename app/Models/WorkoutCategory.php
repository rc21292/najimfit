<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutCategory extends Model
{
    protected $table = "workout_categories";
    protected $fillable = ['name','sort'];
    public $timestamps = true;
}
