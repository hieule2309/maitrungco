<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'slug'   => $this->slug,
            'values' => FilterValueResource::collection($this->whenLoaded('values')),
        ];
    }
}
