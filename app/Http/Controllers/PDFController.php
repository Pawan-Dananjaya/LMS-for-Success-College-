<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pdf;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show PDF materials based on user's grade
     */
    public function index()
    {
        $user = Auth::user();
        $userGrade = $user->grade;
        // Allow teachers and admins to view all materials
        if ($user->isTeacher() || $user->isAdmin()) {
            $grades = [1, 2, 3, 4, 5];
            $title = 'All Grades Learning Materials';
            $description = 'Access to all grade-level ICT materials';
            $gradeRange = '1-5';

            return view('pdf.materials', compact('grades', 'title', 'description', 'gradeRange'));
        }

        if ($userGrade >= 1 && $userGrade <= 2) {
            return redirect()->route('pdf.grade', '1-2');
        } elseif ($userGrade >= 3 && $userGrade <= 5) {
            return redirect()->route('pdf.grade', '3-5');
        }

        return redirect()->route('dashboard')->with('error', 'Invalid grade level');
    }

    /**
     * Show specific grade PDF materials
     */
    public function showGrade($gradeRange)
    {
        $user = Auth::user();
        $userGrade = $user->grade;
        // Teachers and admins can view any grade range
        if ($user->isTeacher() || $user->isAdmin()) {
            if ($gradeRange == '1-2') {
                $grades = [1, 2];
                $title = 'Grade 1-2 Learning Materials';
                $description = 'Foundational ICT courses for young learners';
            } elseif ($gradeRange == '3-5') {
                $grades = [3, 4, 5];
                $title = 'Grade 3-5 Learning Materials';
                $description = 'Advanced ICT courses for intermediate students';
            } else {
                return redirect()->route('dashboard')->with('error', 'Invalid grade range');
            }
        } else {
            // Check access permissions for students
            if ($gradeRange == '1-2') {
                if ($userGrade < 1 || $userGrade > 2) {
                    return redirect()->route('dashboard')
                        ->with('error', 'You do not have access to Grade 1-2 materials.');
                }

                $grades = [1, 2];
                $title = 'Grade 1-2 Learning Materials';
                $description = 'Foundational ICT courses for young learners';

            } elseif ($gradeRange == '3-5') {
                if ($userGrade < 3 || $userGrade > 5) {
                    return redirect()->route('dashboard')
                        ->with('error', 'You do not have access to Grade 3-5 materials.');
                }

                $grades = [3, 4, 5];
                $title = 'Grade 3-5 Learning Materials';
                $description = 'Advanced ICT courses for intermediate students';

            } else {
                return redirect()->route('dashboard')->with('error', 'Invalid grade range');
            }
        }
        
        return view('pdf.materials', compact('grades', 'title', 'description', 'gradeRange'));
    }

    /**
     * Download PDF with access control
     */
    public function downloadPDF($grade)
    {
        $user = Auth::user();
        $userGrade = $user->grade;
        
        // Allow teachers and admins to download any grade
        if (!($user->isTeacher() || $user->isAdmin())) {
            // Check access for students only
            if ($grade >= 1 && $grade <= 2) {
                if ($userGrade < 1 || $userGrade > 2) {
                    abort(403, 'Access denied');
                }
            } elseif ($grade >= 3 && $grade <= 5) {
                if ($userGrade < 3 || $userGrade > 5) {
                    abort(403, 'Access denied');
                }
            } else {
                abort(404);
            }
        }
        
        // Legacy method retained for simple grade downloads. Attempt to find a PDF matching the naming schema first.
        $legacyPath = public_path("pdfs/ICT SIC - Grade {$grade} LMS.pdf");
        if (file_exists($legacyPath)) {
            return response()->download($legacyPath, "Grade_{$grade}_ICT_Materials.pdf");
        }

        // Otherwise, try to find any DB PDF that includes this grade
        $pdf = Pdf::whereJsonContains('grades', intval($grade))->first();
        if ($pdf && file_exists(public_path('pdfs/' . $pdf->filename))) {
            return response()->download(public_path('pdfs/' . $pdf->filename), $pdf->original_name);
        }

        abort(404, 'PDF not found');
    }

    /**
     * Download a PDF by its DB id (admin/teacher downloads and authorization applied)
     */
    public function downloadById($id)
    {
        $user = Auth::user();
        $pdf = Pdf::with('course')->findOrFail($id);

        // Admins/Teachers can download any PDF
        if (!($user->isTeacher() || $user->isAdmin())) {
            // Check student's grade access
            $allowed = false;
            if (!empty($pdf->grades) && is_array($pdf->grades)) {
                $allowed = in_array((int)$user->grade, $pdf->grades, true);
            } elseif ($pdf->course && !empty($pdf->course->grades)) {
                $allowed = in_array((int)$user->grade, $pdf->course->grades, true);
            }

            if (!$allowed) abort(403, 'Access denied');
        }

        $path = public_path('pdfs/' . $pdf->filename);
        if (!file_exists($path)) abort(404, 'PDF not found');

        return response()->download($path, $pdf->original_name);
    }
}
