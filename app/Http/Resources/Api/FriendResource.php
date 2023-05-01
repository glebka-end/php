<?php

namespace App\Http\Resources\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
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
      // 'post_id' => $this->post_id,
      //  'user_id' => $this->user_id,
      // // 'comment' => $this->comment,
      // 'likes_count' => $this->when(
      //   isset($this->user_likes_count),
      //   $this->user_likes_count),

    //   'friends' => $this->when(
    //     isset($this->user_likes_count),
    //     $this->user_likes_count
    // ),
    //  'friends' => $this->where('to_profile_id', '=', 1)
    //  ->where('statuse', '=', 1)
    //  ->count(),
     
      // 'friends' => $this->withCount('subscriptions'),
      //    'user' => UserResource::make($this->whenLoaded('user')),
      // 'user_likes' => UserResource::collection($this->whenLoaded('userLikes')),
    ];
  }
}
