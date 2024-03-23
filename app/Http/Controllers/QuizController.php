<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = QuizResource::collection(Quiz::all());
        return view('quiz.index', ['quizzes' => $quizzes]);
    }

    public function store(QuizRequest $request)
    {
        return new QuizResource(Quiz::create($request->validated()));
    }

    public function show(Quiz $quiz)
    {
        return new QuizResource($quiz);
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $quiz->update($request->validated());

        return new QuizResource($quiz);
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return response()->json();
    }
}
