<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'course_id' => 'required',
            'title' => 'string|required',
            'description' => ['string', 'required'],
            'content' => ['string', 'required'],
            'order' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
