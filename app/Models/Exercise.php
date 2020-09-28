<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = "exercises";
    protected $fillable = ['name', 'category','sort', 'image', 'time', 'calories', 'description'];
    public $timestamps = true;
}
