<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:users,id',
            'assignment_id' => 'required|exists:assignments,id',
            'grade_value' => 'required|numeric|min:0|max:100',
            'graded_at' => 'nullable|date',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
