<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function index()
    {
        $favorites = Course::whereHas('favorites', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('favorites.index', compact('favorites'));
    }
}
