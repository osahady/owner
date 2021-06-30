<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    public function locAds(Request $request, Location $loc)
    {
        return AdResource::collection(
            $loc->ads()
                ->with(['user', 'location', 'category'])
                ->limited($request)
                ->get()
        );
    }

    public function locs()
    {
        return LocationResource::collection(
            Location::all()
        );
    }
}
