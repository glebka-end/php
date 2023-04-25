<?php

namespace App\Http\Resources\Api;

use App\Models\Comment;
use App\Models\Frofile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //   'user_image' => $this->user,
            //  'post_id' => $this->post_id,
            // // 'user_id' => $this->user_id,
            // // 'comment' => $this->comment,
            // 'friends' => $this->when(
            //     isset($this->user_likes_count),
            //     $this->user_likes_count
            // ),
            //    'user' => UserResource::make($this->whenLoaded('user')),
            // 'user_likes' => UserResource::collection($this->whenLoaded('userLikes')),
        ];
    }
}
