<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class GradeTest extends TestCase
{
    use RefreshDatabase;

    private $apiResponceFields = [
        'student_id',
        'assignment' => [
            'id',
            'title',
            'description',
        ],
        'grade_value',
        'graded_at',
    ];

    public function testListGrade()
    {
        Grade::factory(10)->create();

        $this->getJson('api/grade')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->apiResponceFields,
                ],
            ]);
    }

    public function testListGradesFetchAll()
    {
        Grade::factory(100)->create();
        $this->getJson('api/grade')
            ->assertOk()
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->apiResponceFields,
                ],
            ]);
    }

    public function testShowGrade()
    {
        Grade::factory()->create([
            'id' => 1,
        ]);

        $this->getJson('api/grade/1')
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->apiResponceFields,
            ]);
    }

    public function testDeleteGrade()
    {
        Grade::factory()->create([
            'id' => 1,
        ]);

        $this->deleteJson('api/grade/1')
            ->assertNoContent();
    }

    public function testStoreGradeValidation()
    {
        $this->postJson('api/grade')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'student_id',
                    'assignment_id',
                    'grade_value',
                ],
            ]);
    }

    public function testStoreGrade()
    {
        $grade = [
            'student_id' => User::factory()->create()->id,
            'assignment_id' => Assignment::factory()->create()->id,
            'grade_value' => fake()->numberBetween(1, 12),
            'graded_at' => fake()->date(),
        ];

        $this->postJson('api/grade', $grade)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponceFields,
            ]);
    }

    public function testUpdateGrade()
    {
        $grades = Grade::factory()->create();

        $grade = [
            'student_id' => User::factory()->create()->id,
            'assignment_id' => Assignment::factory()->create()->id,
            'grade_value' => fake()->numberBetween(1, 12),
            'graded_at' => Carbon::now(),
        ];

        $response = $this->json('PUT', "api/grade/{$grades->id}", $grade);
        $response->assertOk();
        $grades->refresh();
        $this->assertDatabaseHas('grades', $grade);
        $this->assertEquals($grade['grade_value'], $grades->grade_value);
    }
}
