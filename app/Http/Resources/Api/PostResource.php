<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        
            'id' => $this->id,
            'title' => $this->title,
            'user_id'=> $this->user_id,
            'contente' => $this->contente,
            'image' => Storage::url($this->image),
            'isPublished' =>$this-> isPublished,
            'likes_count' => $this->when(
                isset($this->user_likes_count),
                $this->user_likes_count
            ), 
             'user' => UserResource::make($this->whenLoaded('user')),
            'comment' => CommentResource::
            collection($this->whenLoaded('comments')),

        ];
    }
}
