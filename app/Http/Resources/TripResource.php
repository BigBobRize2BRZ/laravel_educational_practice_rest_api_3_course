<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'number_trip'    => $this->number_trip,
            'departure_date' => $this->departure_date,  
            'arrival_date'   => $this->arrival_date,    
            'bus_id'         => $this->bus_id,
        ];
    }
}
