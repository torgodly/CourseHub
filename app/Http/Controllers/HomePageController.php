<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('welcome', compact('courses'));
    }
}
