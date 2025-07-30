<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = \App\Models\User::first();
    $course = \App\Models\Course::find(1);

//    $user->deposit(1000);

    $user->pay($course);

    dd($course->balance, $user->balance);
    return view('welcome');
});
