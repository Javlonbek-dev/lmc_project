<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;

    private $apiResponseFieldsShow = [
        'title',
        'description',
        'content',
        'course' => [
            'id',
            'title',
        ],
        'order',
        'created_at',
        'updated_at',
    ];

    public function testListLessons()
    {
        Lesson::factory(10)->create();

        $this->getJson('api/lesson')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->apiResponseFieldsShow,
                ],
            ]);
    }

    public function testListLessonsFetchAll()
    {
        Lesson::factory(100)->create();
        $this->getJson('api/lesson')
            ->assertOk()
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->apiResponseFieldsShow,
                ],
            ]);
    }

    public function testShowLesson()
    {
        Lesson::factory()->create([
            'id' => 1,
        ]);

        $this->getJson('api/lesson/1')
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->apiResponseFieldsShow,
            ]);
    }

    public function testDeleteLesson()
    {
        Lesson::factory()->create([
            'id' => 1,
        ]);

        $this->deleteJson('api/lesson/1')
            ->assertNoContent();
    }

    public function testStoreLessonValidation()
    {
        $this->postJson('api/lesson')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'course_id',
                    'title',
                    'description',
                    'content',
                    'order',
                ],
            ]);
    }

    public function testStoreLesson()
    {
        $lesson = [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'course_id' => 1,
            'order' => 1,
        ];

        $this->postJson('api/lesson', $lesson)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponseFieldsShow,
            ]);
    }

    public function testUpdateLesson()
    {
        $lessons = Lesson::factory()->create();

        $lesson = [
            'title' => 'Star Trek ?',
            'description' => 'Example Description',
            'content' => 'Test Content',
            'course_id' => Course::factory()->create()->id,
            'order' => 3,
        ];

        $response = $this->json('PUT', "api/lesson/{$lessons->id}", $lesson);
        $response->assertOk();
        $lessons->refresh();
        $this->assertDatabaseHas('lessons', $lesson);
        $this->assertEquals($lesson['title'], $lessons->title);
        $this->assertEquals($lesson['description'], $lessons->description);
    }
}
