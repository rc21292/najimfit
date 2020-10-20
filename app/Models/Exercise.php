<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = "exercises";
    protected $fillable = ['name', 'name_arabic', 'category','sort', 'image', 'time', 'calories', 'description', 'description_arabic'];
    public $timestamps = true;
}
