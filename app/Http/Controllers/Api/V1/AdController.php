<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function index()
    {
        return Ad::all();
    }

    public function catAds(Category $cat)
    {
        return $cat->ads()->get();
    }
}
