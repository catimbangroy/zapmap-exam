<?php

namespace App\Repository;

use App\Models\Location;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LocationRepository
{
    public function __construct(
        private Location $document,
    ) {
    }

    public function getLocations(array $input): Collection|Location|null
    {
         return Location::select('id', 'name', 'latitude', 'longitude')
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
