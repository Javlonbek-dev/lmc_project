<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function index()
    {
        return AssignmentResource::collection(Assignment::all());
    }

    public function store(AssignmentRequest $request)
    {
        return new AssignmentResource(Assignment::create($request->validated()));
    }

    public function show(Assignment $assignment)
    {
        return new AssignmentResource($assignment);
    }

    public function update(AssignmentRequest $request, Assignment $assignment)
    {
        $assignment->update($request->validated());

        return new AssignmentResource($assignment);
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return response()->json();
    }
}
