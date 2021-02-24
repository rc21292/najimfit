<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientWorkout extends Model
{
    protected $table = "client_workouts";
    protected $fillable = ['client_id', 'category','day', 'exercise', 'sets', 'reps'];
    public $timestamps = true;
}
