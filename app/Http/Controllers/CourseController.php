<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use Bavix\Wallet\Internal\Exceptions\ExceptionInterface;
use FFMpeg\FFProbe;
use getID3;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            case 'specialties':
                $query = $query->whereNotNull('level'); // example condition
                break;
            case 'all':
            default:
                // no extra filtering
                break;
        }

        $courses = $query->paginate(14);

        return view('courses.index', [
            'courses' => $courses,
            'active' => $tab,
            'tags' => $tags,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load([
            'trainer',
            'ratings',
        ])->loadCount([
            'enrollments',
            'sections',
        ]);

        $course->append('average_rating');
        //boolean that is false if the viwer is guest or user that didnt purchase the course
        $locked = auth()->check() && auth()->user()->paid($course);
        $episodes = $course->sections->map(function ($section) use ($locked) {
            $video = $section->getFirstMediaPath('resources_video');
//            dd($video);
            $getID3 = new getID3;
            $info = $getID3->analyze($video);
            $duration = $info['playtime_string'] ?? '00:00:00';
            return [
                'id' => $section->id,
                'number' => $section->order,
                'title' => $section->title,
                'duration' => $duration,
                'completed' => $section->completed,
                'url' => $section->getFirstMediaUrl('resources_video'),
                'thumbnail' => $section->getFirstMediaUrl('resources_thumb'),
                'description' => $section->description,
                'resources' => $section->getMedia('resources'),
                'locked' => !$locked
            ];
        });

        // dd the trailer to the eposides and its not locked
        $trailer = $course->getFirstMediaUrl('promotional_videos');
        $trailer_thumbnail = $course->getFirstMediaUrl('thumbnails');
        $getID3 = new getID3;
        $info = $getID3->analyze($trailer);
        $trailer_duration = $info['playtime_string'] ?? '00:00:00';
        $trailer = [
            'id' => 0, // Assuming trailer is not a section, so id is 0
            'number' => 0, // Trailer does not have a section number
            'title' => __('Trailer'),
            'duration' => $trailer_duration,
            'completed' => false, // Trailer is not completed
            'url' => $trailer,
            'thumbnail' => $trailer_thumbnail,
            'description' => $course->description,
            'resources' => [],
            'locked' => false
        ];
        $episodes = collect([$trailer])->merge($episodes)->sortBy('number')->values()->all();

//        dd($episodes);
        return view('courses.show', compact('course', 'episodes'));
    }

    /**
     * Handle the purchase of a course.
     * @throws ExceptionInterface
     */
    public function purchase(Request $request, Course $course)
    {
        $user = auth()->user();

        if ($user->paid($course)) {
            flash()->error(__('You have already purchased this course.'));
            return redirect()->back()->withErrors(['message' => __('You have already purchased this course.')]);
        }

        if ($user->safePay($course)) {
            flash()->success(__('You have purchased this course successfully!'));
            $user->enroll($course);
            return redirect()->back()->with('message', __('You have purchased this course successfully!'));
        }

        flash()->error(__("Purchase failed: Don't have enough balance."));
        return redirect()->back()->withErrors(['message' => __('Purchase failed.')]);
    }

    /**
     * Handle the enrollment in a course.
     */
    public function enroll(Request $request, Course $course)
    {
        $user = auth()->user();

        if (!$user->paid($course)) {
            return redirect()->back()->withErrors(['message' => __('You must purchase the course before enrolling.')]);
        }

        if ($user->enrollments()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->withErrors(['message' => __('You are already enrolled in this course.')]);
        }


        return redirect()->back()->with('message', __('You have successfully enrolled in the course.'));
    }

    /**
     * Display a specific section of a course.
     */
    public function showSection(Course $course, Section $section)
    {
        $section->load('media');
        return view('courses.sections.show', compact('course', 'section'));
    }

    /**
     * Toggle the favorite status of a course.
     */
    public function toggleFavorite(Request $request, Course $course)
    {

        $user = auth()->user();

        if ($user->favorites()->toggle($course->id)) {
            if ($user->favorites()->where('course_id', $course->id)->exists()) {
                flash()->success(__('Course added to favorite.'));
            } else {
                flash()->info(__('Course removed from favorite.'));
            }
            return redirect()->back()->with('message', __('Course favorite status updated.'));
        }

        flash()->error(__('Failed to update course favorite status.'));
        return redirect()->back()->withErrors(['message' => __('Failed to update course favorite status.')]);
    }

    /**
     * Rate a course.
     */
    public function rate(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = auth()->user();

        $user->ratedCourses()->syncWithoutDetaching([
            $course->id => ['rating' => $request->rating],
        ]);
        flash()->success(__('Course rated successfully.'));
        return redirect()->back()->with('message', __('Course rated successfully.'));
    }


}
