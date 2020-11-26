<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetClients extends Model
{
	protected $table = "password_resets_clients";
    protected $fillable = [
        'email','mobile','token'
    ];
    public $timestamps = true;
}