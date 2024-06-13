<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'description' => 'required',
            'start_date' => ['required'],
            'end_date' => ['required'],
            'duration' => ['required', 'integer'],
            'instructor_id' => ['integer', 'required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
