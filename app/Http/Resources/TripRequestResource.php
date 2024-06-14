<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripRequestResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->tripRequest->name,
            'passenger_count' => $this->tripRequest->passenger_count,
            'destination' => $this->tripRequest->destination,
            'status' => $this->status,
        ];
    }
}
