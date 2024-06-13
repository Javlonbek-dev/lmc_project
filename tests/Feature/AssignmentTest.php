<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AssignmentTest extends TestCase
{
    use RefreshDatabase;

    private $apiResponceFields = [
        'title',
        'description',
        'due_date',
        'max_score',
        'course' => [
            'id',
            'title',
            'description',
        ],
        'created_at',
        'updated_at',

    ];

    public function testListAssignment()
    {
        Assignment::factory(3)->create();
        $response = $this->get('/api/assignment');
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => $this->apiResponceFields,
            ],
        ]);
    }

    public function testListAssignmentFitchAll()
    {
        Assignment::factory(100)->create();
        $response = $this->get('/api/assignment');
        $response->assertJsonCount(100, 'data.*');
        $response->assertJsonStructure([
            'data' => [
                '*' => $this->apiResponceFields,
            ],
        ]);
    }

    public function testShowAssigment()
    {
        Assignment::factory()->create([
            'id' => 1,
        ]);

        $response = $this->get('/api/assignment/1');
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => $this->apiResponceFields,
        ]);
    }

    public function testStoreAssignmentValidation()
    {
        $this->postJson('/api/assignment')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'title',
                    'description',
                    'due_date',
                    'max_score',
                    'course_id',
                ],
            ]);
    }

    public function testStoreAssignment()
    {
        $course = Course::factory()->create();
        $params = [
            'title' => 'Test tile',
            'description' => 'Test Description',
            'due_date' => Carbon::now(),
            'max_score' => 354,
            'course_id' => $course->id,
        ];

        $this->postJson('/api/assignment', $params)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponceFields,
            ]);
    }

    public function testUpdateAssignment()
    {
        $course = Course::factory()->create();
        Assignment::factory()->create([
            'id' => 1,
            'max_score' => 35,
        ]);

        $payload = [
            'title' => 'Name Updated',
            'max_score' => 21,
            'course_id' => $course->id,
            'description' => 'Description Updated',
            'due_date' => Carbon::now(),
        ];

        $this->patchJson('api/assignment/1', $payload)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'title' => 'Name Updated',
                    'max_score' => 21,
                ],
            ])
            ->assertJsonStructure([
                'data' => $this->apiResponceFields,
            ]);
    }

    public function testDeleteAssignment()
    {
        Assignment::factory()->create([
            'id' => 1,
        ]);

        $this->deleteJson('/api/assignment/1')
            ->assertNoContent();
    }
}
