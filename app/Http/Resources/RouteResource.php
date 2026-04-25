<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id'              => $this->id,
            'number_route'    => $this->number_route,
            'start_stop'      => $this->start_stop,
            'end_stop'        => $this->end_stop,
            'price'           => $this->price,
            
            'trips' => TripResource::collection($this->whenLoaded('trips')),
        ];
    }
}
