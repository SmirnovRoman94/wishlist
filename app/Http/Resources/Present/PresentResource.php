<?php

namespace App\Http\Resources\Present;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PresentResource extends JsonResource
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
            'name' => $this->name,
            'url_link' => $this->url_link,
            'description' => $this->description,
            'image_url' => $this->image,
            'comment' => $this->comment,
            'choose_present' => $this->choose_present,
        ];
    }
}
