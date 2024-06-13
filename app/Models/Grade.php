<?php

namespace App\Models;

use App\Enums\UserEnum;
use Database\Factories\GradeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected static string $model_factory = GradeFactory::class;

    protected $table = 'grades';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id')->where('role', UserEnum::Student);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
