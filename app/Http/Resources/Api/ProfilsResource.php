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
            'user_image' => $this->user_image,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ];
    }
}
