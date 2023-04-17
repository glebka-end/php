<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id' => $this->id,
            // 'name' => $this->name,
            // 'email' => $this->email,
            // 'password' => $this->password,

            'user' => $this->user,
            'post_id' => $this->post_id,
            'user_id'=> $this->user_id,
            'comment' => $this->comment,
            // 'image' => $this->image,
            // 'likes' =>$this-> likes,   //comment
            // 'isPublished' =>$this-> isPublished,

        ];
    }
}
