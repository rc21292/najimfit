<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	protected $table = "notes";
    public $timestamps = true;

    protected $fillable = [
        'nutritionist_id','client_id','nutritionist_name','type','client_name','note'
    ];
}
