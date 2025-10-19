<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'grade' => 'nullable|integer|min:1|max:5',
            'password' => 'nullable|confirmed|min:8'
        ]);

        $user->name = $data['name'];
        $user->whatsapp_number = $data['whatsapp_number'] ?? $user->whatsapp_number;
        $user->address = $data['address'] ?? $user->address;
        // Only allow students to set grade
        if ($user->isStudent()) {
            $user->grade = $data['grade'] ?? $user->grade;
        }

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
