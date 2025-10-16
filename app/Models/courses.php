<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'grade_level', 'subject', 
        'thumbnail', 'is_published', 'teacher_id'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrolledStudents()
    {
        return $this->belongsToMany(User::class, 'enrollments')
                    ->withPivot('status', 'progress')
                    ->withTimestamps();
    }
}