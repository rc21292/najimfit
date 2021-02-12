<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title','title_arabic','description','description_arabic','image','image_popup'];
}
