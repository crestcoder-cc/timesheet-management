<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripDetailsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'passenger_count' => $this->passenger_count,
            'destination' => $this->destination,
            'status' => $this->status,
            'driver' => $this->driver->name ?? null,
            'driver_mobile_no' => $this->driver->mobile_no ?? null,
        ];
    }
}
