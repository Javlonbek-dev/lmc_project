<?php

namespace App\Models;

use App\Enums\UserEnum;
use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected static string $model_factory = CourseFactory::class;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'duration',
        'instructor_id',
    ];

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    //    public function user(): BelongsTo
    //    {
    //        return $this->belongsTo(User::class, 'instructor_id');
    //    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id')->where('role', UserEnum::Instructor);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id')->where('role', UserEnum::Student);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
