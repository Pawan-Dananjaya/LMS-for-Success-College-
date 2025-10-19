<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $files = [];
        $path = public_path('pdfs');
        if (is_dir($path)) {
            $all = scandir($path);
            foreach ($all as $f) {
                if (in_array($f, ['.', '..'])) continue;
                $files[] = $f;
            }
        }

        return view('admin.pdfs', compact('files'));
    }

    // Upload PDF
    public function uploadPdf(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:10240'
        ]);

        $file = $request->file('pdf');
        $name = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
        $file->move(public_path('pdfs'), $name);

        return redirect()->route('admin.pdfs')->with('success', 'PDF uploaded.');
    }

    // Delete PDF
    public function deletePdf($filename)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }

        $path = public_path('pdfs/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }

        return redirect()->route('admin.pdfs')->with('success', 'PDF removed.');
    }
}
