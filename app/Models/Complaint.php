<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = "complaints";
    public $timestamps = true;

    protected $fillable = [
        'nutritionist_id','client_id','nutritionist_name','type','client_name','reason'
    ];
}
