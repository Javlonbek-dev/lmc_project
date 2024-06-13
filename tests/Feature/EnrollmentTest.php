<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    private $apiResponseFieldsShow = [
        'users' => [
            'name'
        ],
        'course' =>
            [
                'id',
                'title',
                'description',
            ],
        'enrollment_date',
        'created_at',
        'updated_at',
    ];

    public function testListEnrollments()
    {
        Enrollment::factory(10)->create();

        $this->getJson('api/enrollment')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->apiResponseFieldsShow
                ]
            ]);
    }

    public function testListEnrollmentsFetchAll()
    {
        Enrollment::factory(100)->create();
        $this->getJson('api/enrollment')
            ->assertOk()
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->apiResponseFieldsShow
                ]
            ]);
    }

    public function testShowEnrollment()
    {
        Enrollment::factory()->create([
            'id' => 1
        ]);

        $this->getJson('api/enrollment/1')
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->apiResponseFieldsShow
            ]);
    }

    public function testDeleteEnrollment()
    {
        Enrollment::factory()->create([
            'id' => 1
        ]);

        $this->deleteJson('api/enrollment/1')
            ->assertNoContent();
    }

    public function testStoreEnrollmentValidation()
    {
        $this->postJson('api/enrollment')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'course_id',
                    'student_id',
                    'enrollment_date',
                ],
            ]);
    }

    public function testStoreEnrollment()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $enrollment = [
            'student_id' => $user->id,
            'course_id' => $course->id,
            'enrollment_date' => Carbon::now()
        ];

        $this->postJson('api/enrollment', $enrollment)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponseFieldsShow
            ]);
    }

    public function testUpdateLesson()
    {
        $enrollment = Enrollment::factory()->create();
        $user = User::factory()->create();
        $enrollments = [
            'enrollment_date' => fake()->date(),
            'course_id' => Course::factory()->create()->id,
            'student_id' => $user->id,
        ];

        $response = $this->json('PUT', "api/enrollment/{$enrollment->id}", $enrollments);
        $response->assertOk();
        $enrollment->refresh();
        $this->assertDatabaseHas('enrollments', $enrollments);
        $this->assertEquals($enrollments['enrollment_date'], $enrollment->enrollment_date);
    }
}
