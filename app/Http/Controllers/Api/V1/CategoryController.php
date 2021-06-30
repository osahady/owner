<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function hisAds(Request $request, Category $cat, User $user)
    {
        return AdResource::collection(
            $user->ads()
                ->where('category_id', $cat->id)
                ->with(['user', 'location', 'category'])
                ->limited($request)
                ->get()
        );
    }

    public function catLocAds(Request $request, Category $cat, Location $loc)
    {
        return AdResource::collection(
            $cat->ads()
                ->where('location_id', $loc->id)
                ->with(['user', 'location', 'category'])
                ->limited($request)
                ->get()
        );
    }

    public function cats()
    {
        return CategoryResource::collection(
            Category::all()
        );
    }
}
