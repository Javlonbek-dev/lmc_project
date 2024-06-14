<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    private $apiResponceFields = [
        'title',
        'description',
        'duration',
        'course' => [
            'id',
            'title'
        ],
    ];

    public function testListLessons()
    {
        Quiz::factory(3)->create();

        $this->getJson('/api/quiz')->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->apiResponceFields
                ]
            ]);
    }

    public function testShowAllQuizzes()
    {
        Quiz::factory(100)->create();

        $this->getJson('/api/quiz')->assertStatus(200)
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->apiResponceFields]]);
    }

    public function testShowQuiz()
    {
        Quiz::factory()->create([
            'id'=>1
        ]);

        $this->getJson('api/quiz/1')
            ->assertOk()
            ->assertJsonStructure([
                'data'=>$this->apiResponceFields
            ]);
    }

    public function testDeleteQuiz()
    {
        Quiz::factory()->create([
            'id'=>1
        ]);

        $this->deleteJson('api/quiz/1')
            ->assertNoContent();
    }

    public function testStoreQuiz()
    {

        $quiz=[
            'title'=>fake()->title(),
            'description'=>fake()->text(),
            'duration'=>fake()->numberBetween(1,60),
            'course_id'=>Course::factory()->create()->id
        ];
        $this->postJson('api/quiz',$quiz)
            ->assertCreated()
        ->assertJsonStructure([
            'data'=>$this->apiResponceFields
        ]);

    }

    public function testStoreQuizValidation()
    {
        $this->postJson('api/quiz')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors'=>[
                    'title',
                    'description',
                    'duration',
                    'course_id'
                ]
            ]);
    }

    public function testUpdateQuiz()
    {
       $quizzes= Quiz::factory()->create();

        $quiz=[
            'title'=>fake()->title(),
            'description'=>fake()->text(),
            'duration'=>fake()->numberBetween(1,60),
            'course_id'=>Course::factory()->create()->id
        ];

        $response = $this->json('PUT', "api/quiz/{$quizzes->id}", $quiz);
        $response->assertOk();

        $quizzes->refresh();

        $this->assertDatabaseHas('quizzes', $quiz);
        $this->assertEquals($quiz['title'],$quizzes->title);
    }
}
