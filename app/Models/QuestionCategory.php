<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    protected $table = "question_categories";
    protected $fillable = ['name','description'];
    public $timestamps = false;

    public function questions(){
    	return$this->hasMany('App\Models\Question','category');
    }
}
