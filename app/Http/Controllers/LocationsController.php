<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationsRequest;
use App\Http\Resources\LocationResource;
use App\Services\LocationService;
use App\Transformers\LocationTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationsController extends Controller
{
    protected LocationService $locationRepository;

    protected LocationTransformer $locationTransformer;

    public function __construct(LocationService $locationRepository, LocationTransformer $locationTransformer)
    {
        $this->locationRepository = $locationRepository;
        $this->locationTransformer = $locationTransformer;
    }
    public function index(LocationsRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $locations = $this->locationRepository->getLocations($request->input());
        $response = LocationResource::collection($locations);

        if (!$response->count()) {
            return response()->json([
                'errors' => __('No locations found.'),
            ], 404);
        }
        return $response;
    }
}
