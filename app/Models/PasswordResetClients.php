<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetClients extends Model
{
	protected $table = "password_resets_clients";
    protected $fillable = [
        'email', 'token'
    ];
    public $timestamps = true;
}