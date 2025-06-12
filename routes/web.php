<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/exception', function () {
    throw new Exception('This is a test exception');
});
