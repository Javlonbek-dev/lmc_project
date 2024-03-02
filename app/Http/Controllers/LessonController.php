<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function index()
    {
        return LessonResource::collection(Lesson::all());
    }

    public function store(LessonRequest $request)
    {
        return new LessonResource(Lesson::create($request->validated()));
    }

    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());

        return new LessonResource($lesson);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json();
    }
}
