<?php

namespace App\Repository;

use App\Models\Location;
use Illuminate\Support\Collection;

class LocationRepository
{
    public function __construct(
        protected Location $location,
    ) {
    }

    public function getLocations(array $input): Collection|Location|null
    {
         return $this->location->select('id', 'name', 'latitude', 'longitude')
            ->selectRaw("
                (
                    6371 * ACOS(
                        COS(RADIANS(?)) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(?)) +
                        SIN(RADIANS(?)) * SIN(RADIANS(latitude))
                    )
                ) AS distance", [$input['latitude'], $input['longitude'], $input['latitude']])
            ->havingRaw('distance <= ?', [$input['radius']])
            ->get();
    }
}
