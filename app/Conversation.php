<?php

namespace App;
use App\Models\User;
use App\Group;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['message', 'user_id', 'group_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
