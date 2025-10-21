<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $table = 'pdfs';

    protected $fillable = [
        'filename', 'original_name', 'course_id', 'grades', 'uploaded_by'
    ];

    protected $casts = [
        'grades' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
