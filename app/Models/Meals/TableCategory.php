<?php

namespace App\Models\Meals;

use Illuminate\Database\Eloquent\Model;

class TableCategory extends Model
{
    protected $table = "tables";
    protected $fillable = ['name','sort'];
    public $timestamps = true;
}
