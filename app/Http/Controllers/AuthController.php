<?php

namespace App\Http\Controllers;

use App\Models\Users;
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
            $request->session()->regenerate();
            
            // Redirect to welcome page after login
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
     * Handle registration request
     */
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:student,teacher',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'grade' => 'nullable|string|max:50' // Changed to nullable
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create user
        $users = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'whatsapp_number' => $request->whatsapp_number,
            'address' => $request->address,
            'grade' => $request->role === 'student' ? $request->grade : null, // Only set grade for students
            'is_active' => true
        ]);

        // Login user automatically after registration
        Auth::login($users);

        // Redirect to welcome page after registration
        return redirect()->route('home')->with('success', 'Registration successful! Welcome to College LMS.');
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