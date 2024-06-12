<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function store(CourseRequest $request)
    {
        if (!auth()->user()->can('create', Course::class)) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }
        return new CourseResource(Course::create($request->validated()));
    }

    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    public function update(CourseRequest $request, Course $course)
    {

        if (!auth()->user()->can('update', $course)) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }
        $course->update($request->validated());

        return new CourseResource($course);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if (Gate::denies('delete-course', $course)) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }
        $course->delete();

        return response()->noContent();
    }
}
