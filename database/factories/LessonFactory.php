<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'title'=>$this->faker->sentence(20),
            'description'=>$this->faker->paragraph(0.5),
            'content'=>$this->faker->paragraph(0.5),
            'course_id'=>Course::factory(),
            'order'=>$this->faker->numberBetween(1,10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
