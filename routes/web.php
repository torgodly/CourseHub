<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});
//login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
