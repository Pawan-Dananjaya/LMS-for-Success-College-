<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@college.edu',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'whatsapp_number' => '+1234567890',
            'address' => 'College Administration Building',
            'grade' => null,
            'is_active' => true
        ]);

        // Create sample teacher
        User::create([
            'name' => 'John Smith',
            'email' => 'teacher@college.edu',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'whatsapp_number' => '+1234567891',
            'address' => 'Teacher Quarters',
            'grade' => null,
            'is_active' => true
        ]);

        // Create sample student
        User::create([
            'name' => 'Student One',
            'email' => 'student@college.edu',
            'password' => Hash::make('password'),
            'role' => 'student',
            'whatsapp_number' => '+1234567892',
            'address' => 'Student Hostel',
            'grade' => 'Grade 5',
            'is_active' => true
        ]);

        // Create more sample users
        User::factory(10)->create();
    }
}