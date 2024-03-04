<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'due_date' => ['required', 'date'],
            'max_score' => ['required', 'integer'],
            'course_id' => ['required']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
