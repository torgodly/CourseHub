<?php

namespace App\Http\Controllers;

use Bavix\Wallet\Services\PurchaseService;
use Illuminate\Http\Request;

class PurchasedCourseController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $purchasedCourses = $user->enrollments()
            // ->where('status', \App\Enum\EnrollmentStatus::Completed->value)
            ->with('course')
            ->get()
            ->map(function ($enrollment) {
                return $enrollment->course;
            });
        return view('purchasedCourse.index', compact('purchasedCourses'));
    }
}
