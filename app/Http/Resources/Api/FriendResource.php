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
      'subscriptions_count' => Profile::withCount('subscriptions')->count(),
    ];
  }
}
