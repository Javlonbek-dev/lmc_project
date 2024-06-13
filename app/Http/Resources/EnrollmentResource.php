<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Enrollment */
class EnrollmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'users' => [
                'name' => 'Jalol',
            ],
            'course' => [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
            ],
            'enrollment_date' => $this->enrollment_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
