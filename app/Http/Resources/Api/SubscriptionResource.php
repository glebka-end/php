<?php

namespace App\Http\Resources\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
      'user_id' => $this->user_id,
      'user_image' => $this->User_image,
      'is_online' => $this->is_online,
      'status' => $this->status,
      'total_number_of_games' => $this->total_number_of_games,
      'won_games' => $this->won_games,
    
      //   'likes_count' => $this->when(
      //     isset($this->user_likes_count),
      //     $this->user_likes_count
      // ), 
    ];
  }
}
