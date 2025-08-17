<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use Bavix\Wallet\Internal\Exceptions\ExceptionInterface;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'all'); // default: all


        $query = Course::query()->with('trainer');

        switch ($tab) {
            case 'new':
                $query = $query->orderBy('created_at', 'desc');
                break;

            case 'popular':
                $query = $query->orderBy('created_at', 'asc'); // or 'students_count' if you track that
                break;

            case 'specialties':
                $query = $query->whereNotNull('level'); // example condition
                break;

            case 'all':
            default:
                // no extra filtering
                break;
        }

        $courses = $query->paginate(5);

        return view('courses.index', [
            'courses' => $courses,
            'active' => $tab,
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

        return view('courses.show', compact('course'));
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

        $user->enroll($course);

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
