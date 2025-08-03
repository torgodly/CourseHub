<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('course')->get();

        return view('favorites.index', compact('favorites'));
    }
}
