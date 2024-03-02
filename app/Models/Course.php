<?php

namespace App\Models;

use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected static string $model_factory = CourseFactory::class;
    protected $table = 'ed_courses';
    protected $guarded = [];
}
