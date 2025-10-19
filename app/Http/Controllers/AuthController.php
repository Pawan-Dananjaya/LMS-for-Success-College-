<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Prevent inactive users from logging in
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is pending approval by the administrator.']);
            }

            $request->session()->regenerate();
            // Redirect based on role/grade
            if ($user->role === 'teacher' || $user->role === 'admin') {
                return redirect()->route('pdf.index')->with('success', 'Login successful! You have access to all materials.');
            }

            if ($user->role === 'student' && $user->grade >= 3 && $user->grade <= 5) {
                return redirect()->route('pdf.grade', '3-5')->with('success', 'Login successful! Welcome to your learning materials.');
            }
 
            // Default: redirect to home
            return redirect()->route('home')->with('success', 'Login successful! Welcome back.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show registration form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Normalize grade input (accept "Grade 1", "1", "grade1", etc.)
     */
    protected function normalizeGrade($raw): ?int
    {
        if (is_null($raw) || $raw === '') {
            return null;
        }

        // If already integer-like, cast and validate range
        if (is_int($raw) || ctype_digit((string)$raw)) {
            $g = (int)$raw;
            return ($g >= 1 && $g <= 5) ? $g : null;
        }

        // Try to extract first digit 1..5 from string like "Grade 1", "grade1", "G1"
        if (preg_match('/([1-5])/', (string)$raw, $m)) {
            return (int)$m[1];
        }

        return null;
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:student,teacher',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            // allow either integer or string (we'll normalize). Validate loosely then normalize below.
            'grade' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // normalize grade to integer 1..5 if provided and role is student
        $normalizedGrade = null;
        if ($request->filled('grade') && $request->input('role') === 'student') {
            $normalizedGrade = $this->normalizeGrade($request->input('grade'));
        }

        // Create user but mark as inactive until admin approves
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'whatsapp_number' => $request->whatsapp_number,
            'address' => $request->address,
            'grade' => $request->role === 'student' ? $normalizedGrade : null,
            'is_active' => false, // require admin approval
        ]);

    // Registration successful but pending admin approval
    return redirect()->route('home')->with('success', 'Registration successful! Your account is pending admin approval. You will receive an email or notification once approved.');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}
