<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        return CourseResource::collection(Course::all());
    }

    public function store(CourseRequest $request)
    {
        return new CourseResource(Course::create($request->validated()));
    }

    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return new CourseResource($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json();
    }
}
