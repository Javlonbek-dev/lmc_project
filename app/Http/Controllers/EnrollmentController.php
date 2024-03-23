<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentRequest;
use App\Http\Resources\EnrollmentResource;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments=EnrollmentResource::collection(Enrollment::all());
        return view('enrollment.index', ['enrollments'=>$enrollments]);
    }

    public function store(EnrollmentRequest $request)
    {
        return new EnrollmentResource(Enrollment::create($request->validated()));
    }

    public function show(Enrollment $enrollment)
    {
        return new EnrollmentResource($enrollment);
    }

    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validated());

        return new EnrollmentResource($enrollment);
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return response()->json();
    }
}
