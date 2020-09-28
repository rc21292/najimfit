<?php

use Illuminate\Support\Facades\Route;

Route::get('/nutritionist', function () {
    return view('welcome');
});