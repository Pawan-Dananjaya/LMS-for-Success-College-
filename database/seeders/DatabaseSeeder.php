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
        // Create admin user (per request)
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('successpassword1'),
                'role' => 'admin',
                'whatsapp_number' => '+1234567890',
                'address' => 'College Administration Building',
                'grade' => null,
                'is_active' => true
            ]
        );

        // Create sample teacher (idempotent)
        User::updateOrCreate(
            ['email' => 'teacher@gmail.com'],
            [
                'name' => 'John Smith',
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'whatsapp_number' => '+1234567891',
                'address' => 'Teacher Quarters',
                'grade' => null,
                'is_active' => true
            ]
        );

        // Create sample student (idempotent)
        User::updateOrCreate(
            ['email' => 'student@gmail.com'],
            [
                'name' => 'Student One',
                'password' => Hash::make('password'),
                'role' => 'student',
                'whatsapp_number' => '+1234567892',
                'address' => 'Student Hostel',
                'grade' => 5,
                'is_active' => true
            ]
        );

    // (Optional) create more sample users via factories if available
    }
}