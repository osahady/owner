<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;

class AdController extends Controller
{
    public function index()
    {
        return AdResource::collection(
            Ad::all()
        );
    }

    public function catAds(Category $cat)
    {
        return AdResource::collection(
            $cat->ads()
            ->with(['user', 'location', 'category'])
            ->get()
        );
    }

    public function store()
    {
        
    }
}
