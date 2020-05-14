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
            "id" => $this->id,
            "title" => $this->title,
            "path" => $this->path,
            "body" => $this->body,
            "replies" => ReplyResource::collection($this->replies),
            "replies_count" => $this->replies->count(),
            "created_at" => $this->created_at->format("d-m-y"),
            "user" => $this->user->name,
            "user_id" => $this->user_id,
            "slug" => $this->slug,
        ];
    }
}
