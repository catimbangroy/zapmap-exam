<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationsRequest;
use App\Http\Resources\LocationResource;
use App\Services\LocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationsController extends Controller
{
    public function __construct(
        protected LocationService $locationService,
    ) {
    }

    public function index(LocationsRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $locations = $this->locationService->getLocations($request->input());
        $response = LocationResource::collection($locations);

        if (!$response->count()) {
            return response()->json([
                'errors' => __('No locations found.'),
            ], 404);
        }
        return $response;
    }
}
