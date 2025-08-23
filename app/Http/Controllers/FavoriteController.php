<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function index()
    {
        $favorites = Course::whereHas('favoritedBy', function ($query) {
            $query->where('user_id', auth()->id());
        })->paginate(10);

        return view('favorites.index', compact('favorites'));
    }
}
