<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'start_date' => Carbon::now(),
            'instructor_id' => $this->faker->numberBetween(1, 3,),
            'end_date' => Carbon::now(),
            'duration' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
