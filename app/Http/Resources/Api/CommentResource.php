<?php

namespace App\Http\Resources\Api;

use App\Models\Comment;
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
            //   'user' => $this->user,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'comment' => $this->comment,
            'likes_count' => $this->when(
                isset($this->user_likes_count),
                $this->user_likes_count
            ),
            'user' => UserResource::make($this->whenLoaded('user')),
            
        ];
    }
}
