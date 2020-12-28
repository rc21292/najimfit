<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Faq extends Model
{ 
    public $timestamps =false;
    public function setSlugAttribute($value)
    {
        if (!empty($value)) {
            $temp = str_slug($value, '-');
            if (!Faq::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Faq::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }   

    public function saveFaq($request)
    {
        if (!empty($request)) {

            $this->question = filter_var($request['question'], FILTER_SANITIZE_STRING);
            $this->question_arabic = filter_var($request['question_arabic'], FILTER_SANITIZE_STRING);
            $this->answer = filter_var($request['answer'], FILTER_SANITIZE_STRING);
            $this->answer_arabic = filter_var($request['answer_arabic'], FILTER_SANITIZE_STRING);
            if ($request['status'] == "on") {
                $this->status = 1;
            }else{
                $this->status = 0;
            }
            return $this->save();
        }
    }

    public function updateFaq($request, $id)
    {
        if (!empty($request)) {
            $faq = self::select('id')->where('id', $id)->first();
            $faq->question = filter_var($request['question'], FILTER_SANITIZE_STRING);
            $faq->question_arabic = filter_var($request['question_arabic'], FILTER_SANITIZE_STRING);
            $faq->answer = filter_var($request['answer'], FILTER_SANITIZE_STRING);
            $faq->answer_arabic = filter_var($request['answer_arabic'], FILTER_SANITIZE_STRING);
            if ($request['status'] == "on") {
                $faq->status = 1;
            }else{
                $faq->status = 0;
            }
            $faq->save();
        }
    } 
}