<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";
    protected $fillable = ['gender', 'sort','question','category','image','unit'];
    public $timestamps = true;

    public function questioncategory(){
    	return$this->belongsTo('App\Models\QuestionCategory');
    }
}

