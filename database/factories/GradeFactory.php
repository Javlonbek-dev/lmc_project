<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GradeFactory extends Factory
{
    protected $model = Grade::class;

    public function definition(): array
    {
        return [
            'student_id' => User::factory(),
            'assignment_id' => Assignment::factory(),
            'grade_value' => $this->faker->numberBetween(1, 12),
            'graded_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
