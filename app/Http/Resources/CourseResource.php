<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'duration'=>$this->duration,
            'instructor_id' => $this->instructor_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
