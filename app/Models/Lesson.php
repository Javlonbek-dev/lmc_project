<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected static string $model_factory = LessonFactory::class;
    protected $table = 'ed_courses';
    protected $guarded = [];
}
