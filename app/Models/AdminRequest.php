<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRequest extends Model
{
    protected $table = "admin_requests";
    public $timestamps = true;

    protected $fillable = [
        'nutritionist_id','client_id','nutritionist_name','type','client_name','reason'
    ];
}
