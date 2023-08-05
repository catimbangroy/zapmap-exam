<?php

namespace App\Services;

use App\Models\Location;
use App\Repository\LocationRepository;
use Illuminate\Support\Collection;

class LocationService
{
    protected LocationRepository $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function getLocations(array $input): Collection|Location
    {
        return $this->locationRepository->getLocations($input);
    }
}
