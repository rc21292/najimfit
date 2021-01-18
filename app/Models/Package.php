<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = "packages";
    protected $fillable = ['name', 'includes','sort','workout_days','off_days', 'price', 'validity', 'target', 'description','status','image','type'];
    public $timestamps = true;
}
