<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function hisAds(Category $cat, User $user)
    {
       return $user
                ->ads()
                ->where('category_id', $cat->id)
                ->get();
    }

    public function catLocAds(Category $cat, Location $loc)
    {
       return $cat
                ->ads()
                ->where('location_id', $loc->id)
                ->get();
    }
}
