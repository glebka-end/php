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
            // 'id' => $this->id,
            // 'name' => $this->name,
            // 'email' => $this->email,
            // 'password' => $this->password,

            'id' => $this->id,
            'title' => $this->title,
            'user_id'=> $this->user_id,
            'contente' => $this->contente,
            'image' => Storage::url($this->image),//оборач 
            'likes' =>$this-> likes,   //comment
            'isPublished' =>$this-> isPublished,
            'posts' => PostResource::collection($this->whenLoaded('comment')),

        ];
    }
}
