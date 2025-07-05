<?php

namespace App\Http\Resources\Link;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
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
            'original' => $this->original,
            'short' => env('APP_URL') . '/' . "$this->short",
        ];
    }
}
