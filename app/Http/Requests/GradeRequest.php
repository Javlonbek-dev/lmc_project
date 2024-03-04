<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'student_id' => ['required', 'integer'],
            'assignment_id' => ['required', 'integer'],
            'grade_value' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
