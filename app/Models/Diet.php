<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    protected $table = "intake_substances";
    protected $fillable = ['image','serving_size','grams_per_serving','time','type'];
    public $timestamps = true;
}
