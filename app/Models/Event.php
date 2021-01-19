<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id ','title', 'start', 'end', 'comments', 'type'
    ];
    public $timestamps = true;
}
