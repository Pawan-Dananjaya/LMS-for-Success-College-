<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pdf;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // List pending users
    public function pending()
    {
        // only admins
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $users = User::where('is_active', false)->orderBy('created_at', 'desc')->get();
        return view('admin.pending', compact('users'));
    }

    // Approve a user
    public function approve($id)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->is_active = true;
        $user->save();

        return redirect()->route('admin.pending')->with('success', 'User approved.');
    }

    // Reject (delete) a user
    public function reject($id)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pending')->with('success', 'User rejected and removed.');
    }

    // List PDFs
    public function pdfs()
    {
        // Allow both admins and teachers to manage PDFs
        if (!auth()->check() || (!auth()->user()->isAdmin() && !auth()->user()->isTeacher())) {
            abort(403);
        }
        // Load courses for selection and existing db pdf records
        $courses = Course::orderBy('title')->get();
        $dbPdfs = Pdf::with(['course', 'uploader'])->orderBy('created_at', 'desc')->get();

        // Build a display list merging DB records and filesystem files
        $display = [];

        // Add DB records first
        foreach ($dbPdfs as $p) {
            $display[] = (object) [
                'type' => 'db',
                'id' => $p->id,
                'filename' => $p->filename,
                'original_name' => $p->original_name,
                'course' => $p->course,
                'grades' => $p->grades,
                'uploader' => $p->uploader,
                'created_at' => $p->created_at,
            ];
        }

        // Scan public/pdfs for legacy files and include ones not in DB
        $path = public_path('pdfs');
        if (is_dir($path)) {
            $all = scandir($path);
            foreach ($all as $f) {
                if (in_array($f, ['.', '..'])) continue;
                // skip if already in DB
                if ($dbPdfs->where('filename', $f)->count() > 0) continue;

                // attempt to infer grade from filename (e.g., 'Grade 1')
                $grades = null;
                if (preg_match('/Grade\s*(\d+)/i', $f, $m)) {
                    $grades = [(int)$m[1]];
                }

                $display[] = (object) [
                    'type' => 'file',
                    'filename' => $f,
                    'original_name' => $f,
                    'course' => null,
                    'grades' => $grades,
                    'uploader' => null,
                    'created_at' => filemtime($path . '/' . $f) ? \Carbon\Carbon::createFromTimestamp(filemtime($path . '/' . $f)) : null,
                ];
            }
        }

        return view('admin.pdfs', ['pdfs' => collect($display), 'courses' => $courses]);
    }

    // Upload PDF
    public function uploadPdf(Request $request)
    {
        // Allow both admins and teachers to upload PDFs
        if (!auth()->check() || (!auth()->user()->isAdmin() && !auth()->user()->isTeacher())) {
            abort(403);
        }

        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:10240',
            'course_id' => 'nullable|exists:courses,id',
            'grades' => 'nullable|array',
            'grades.*' => 'integer|min:1'
        ]);

        $file = $request->file('pdf');
        $original = $file->getClientOriginalName();
        $name = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $original);
        $file->move(public_path('pdfs'), $name);

        $pdf = Pdf::create([
            'filename' => $name,
            'original_name' => $original,
            'course_id' => $request->input('course_id'),
            'grades' => $request->input('grades') ?: null,
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('admin.pdfs')->with('success', 'PDF uploaded.');
    }

    // Delete PDF
    public function deletePdf($filename)
    {
        // Allow both admins and teachers to delete PDFs
        if (!auth()->check() || (!auth()->user()->isAdmin() && !auth()->user()->isTeacher())) {
            abort(403);
        }

        $pdf = Pdf::where('filename', $filename)->first();
        if ($pdf) {
            $path = public_path('pdfs/' . $pdf->filename);
            if (file_exists($path)) unlink($path);
            $pdf->delete();
        } else {
            // fallback to direct file remove if record missing
            $path = public_path('pdfs/' . $filename);
            if (file_exists($path)) unlink($path);
        }

        return redirect()->route('admin.pdfs')->with('success', 'PDF removed.');
    }
}
