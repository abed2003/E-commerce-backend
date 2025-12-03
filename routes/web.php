<?php

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

