<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'course_id' => 'required',
            'title' => ['string', 'required'],
            'description' => ['string', 'required'],
            'duration'=>['integer','required']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
