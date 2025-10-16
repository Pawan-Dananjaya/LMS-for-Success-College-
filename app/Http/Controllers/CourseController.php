<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('teacher')->where('is_published', true);

        if ($request->has('grade')) {
            $query->where('grade_level', $request->grade);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->paginate(12);
        $grades = ['Grade 1-2', 'Grade 3-5'];

        return view('courses.index', compact('courses', 'grades'));
    }

    public function show($id)
    {
        $course = Course::with(['lessons', 'teacher'])->findOrFail($id);
        
        if (auth()->check()) {
            $enrollment = Enrollment::where('user_id', auth()->id())
                ->where('course_id', $id)
                ->first();
        } else {
            $enrollment = null;
        }

        return view('courses.show', compact('course', 'enrollment'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'grade_level' => 'required|string',
            'subject' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'grade_level' => $request->grade_level,
            'subject' => $request->subject,
            'thumbnail' => $thumbnailPath,
            'teacher_id' => auth()->id(),
            'is_published' => $request->has('publish')
        ]);

        return redirect()->route('courses.show', $course->id)
            ->with('success', 'Course created successfully!');
    }

    public function enroll($id)
    {
        $course = Course::findOrFail($id);

        // Check if already enrolled
        $existingEnrollment = Enrollment::where('user_id', auth()->id())
            ->where('course_id', $id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        Enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $id,
            'status' => 'active'
        ]);

        return redirect()->route('courses.show', $id)
            ->with('success', 'Successfully enrolled in the course!');
    }
}