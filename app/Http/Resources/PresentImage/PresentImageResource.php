<?php

namespace App\Http\Resources\PresentImage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PresentImageResource extends JsonResource
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
            'path' => $this->path,
            'url' => $this->url
        ];
    }
}
