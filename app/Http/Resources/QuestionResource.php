<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "path" => $this->path,
            "body" => $this->body,
            "created_at" => $this->created_at->format("d-m-y"),
            "user" => $this->user->name,
        ];
    }
}
