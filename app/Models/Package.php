<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = "packages";
    protected $fillable = ['name', 'includes','sort', 'price', 'validity', 'target', 'description','status','image'];
    public $timestamps = true;
}
