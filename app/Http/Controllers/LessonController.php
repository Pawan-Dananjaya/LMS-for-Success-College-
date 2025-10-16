<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function show($courseId, $lessonId)
    {
        $course = Course::findOrFail($courseId);
        $lesson = Lesson::where('course_id', $courseId)->findOrFail($lessonId);
        $lessons = Lesson::where('course_id', $courseId)->orderBy('order')->get();

        $nextLesson = Lesson::where('course_id', $courseId)
            ->where('order', '>', $lesson->order)
            ->orderBy('order')
            ->first();

        $prevLesson = Lesson::where('course_id', $courseId)
            ->where('order', '<', $lesson->order)
            ->orderBy('order', 'desc')
            ->first();

        return view('lessons.show', compact('course', 'lesson', 'lessons', 'nextLesson', 'prevLesson'));
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('lessons.create', compact('course'));
    }

    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'document' => 'nullable|file|max:10240',
            'order' => 'required|integer'
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('lesson-documents', 'public');
        }

        Lesson::create([
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'document_path' => $documentPath,
            'order' => $request->order,
            'course_id' => $courseId
        ]);

        return redirect()->route('courses.show', $courseId)
            ->with('success', 'Lesson created successfully!');
    }
}