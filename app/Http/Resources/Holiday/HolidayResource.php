<?php

namespace App\Http\Resources\Holiday;

use App\Http\Resources\Present\PresentResource;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidayResource extends JsonResource
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
            'description' => $this->description,
            'date' => $this->date,
            'image' => $this->holiday_img,
            'user_id' => $this->user_id,
            'presents' => isset($this->presents) ? PresentResource::collection($this->presents)->resolve() : [],
        ];
    }
}
