<?php

namespace Tests\Feature;

use App\Enums\UserEnum;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CourseTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_show_all_courses()
    {
        Course::factory()->count(3)->create();

        $this->json('GET', 'api/course')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' =>
                    ['id', 'title', 'description', 'start_date', 'end_date', 'duration', 'instructor_id', 'created_at', 'updated_at']
            ]);
    }

    public function test_can_show_course()
    {
        $instructor = User::factory()->create();
        $course = Course::factory()->create(['instructor_id' => $instructor->id]);
        $response = $this->json('GET', "/api/course/{$course->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'title', 'description', 'start_date', 'end_date',
                    'duration', 'instructor_id', 'created_at', 'updated_at'
                ],
            ])
            ->assertJsonFragment([
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'instructor_id' => $course->instructor_id,
            ]);
    }

    public function test_can_create_course()
    {
        $instructor = User::factory()->create(['email_verified_at' => now()]);

        Sanctum::actingAs($instructor);

        $params = $this->validParams();

        $this->json('POST', '/api/course', $params)
            ->assertCreated();

        $params['start_date'] = Carbon::yesterday()->second(0)->toDateTimeString();
        $this->assertDatabaseHas('courses', $params);
    }

//    public function testCourseCreateUnauthorized()
//    {
//        $instructor = User::factory()->create(['email_verified_at' => now()]);
//
//        Sanctum::actingAs($instructor);
//        $this->json('POST', '/api/course/', $this->validParams())
//            ->assertForbidden()
//            ->assertJson([
//                'message' => 'Unauthorized.'
//            ]);
//    }

    public function test_can_update_course()
    {
        $instructor = User::factory()->create(['email_verified_at' => now()]);

        Sanctum::actingAs($instructor);
        $course = Course::factory()->create();
        $params = $this->validParams();
        $response=$this->json('PATCH', "/api/course/{$course->id}", $params);
        $response->assertOk();

        $course->refresh();

        $this->assertDatabaseHas('courses', $params);
        $this->assertEquals($course->title, $params['title']);
        $this->assertEquals($course->description, $params['description']);
    }

//    public function testCourseUpdateUnauthorized()
//    {
//        $instructor = User::factory()->create(['email_verified_at' => now()]);
//        Sanctum::actingAs($instructor);
//
//        $course = Course::factory()->create();
//
//        $this->json('PATCH', "/api/course/{$course->id}", $this->validParams())
//            ->assertForbidden()
//            ->assertJson([
//                'message' => 'Unauthorized.'
//            ]);
//    }
    public function test_can_delete_course()
    {
        $instructor = User::factory()->create(['email_verified_at' => now()]);

        Sanctum::actingAs($instructor);

        $course = Course::factory()->create(['instructor_id' => $instructor->id]);

        $this->json('DELETE', "/api/course/{$course->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('courses',['id' => $course->id]);
    }

    public function testCourseDeleteUnauthorized()
    {
        $course = Course::factory()->create();
        $instructor = User::factory()->create(['email_verified_at' => now()]);
        Sanctum::actingAs($instructor);
        $this->json('DELETE', "/api/course/{$course->id}")
            ->assertStatus(403)
            ->assertJson([
                'message' => 'This action is unauthorized.'
            ]);

        $this->assertDatabaseHas('courses', $course->toArray());
    }

    private function validParams(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Star Trek ?',
            'description' => 'Example Description',
            'start_date' => Carbon::yesterday()->format('Y-m-d\TH:i'),
            'end_date' => Carbon::tomorrow()->format('Y-m-d\TH:i'),
            'instructor_id' => User::factory()->create()->id,
            'duration' => 3,
        ], $overrides);
    }
}
