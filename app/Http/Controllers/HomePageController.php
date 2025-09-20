<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();
        $tab = $request->get('tab', 'all'); // default: all
        $tag = $request->get('tag');
        $search = $request->get('search');
        $query = Course::query()->with('trainer')->orderBy('created_at', 'desc');
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }
        if ($tag) {
            $query->withAnyTags([$tag]);
        }
        switch ($tab) {
            case 'new':
                $query = $query->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $query = $query->withCount('enrollments')->orderBy('enrollments_count', 'desc');
                break;

            case 'all':
            default:
                // no extra filtering
                break;
        }

        $courses = $query->paginate(14);
        return view('welcome', compact('courses', 'tags', 'tab'));
    }
}
