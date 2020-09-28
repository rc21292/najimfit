<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupons";
    protected $fillable = ['name', 'package_id', 'type', 'discount', 'date_start', 'date_end', 'status','used_by'];
    public $timestamps = true;
}
