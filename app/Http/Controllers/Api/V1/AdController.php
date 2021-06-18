<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
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

    public function store(AdRequest $request)
    {
        $fields = $request->validated();
        $user = $request->user();
        $user->ads()->create([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'price' => $fields['price'],
            'category_id' => $fields['category_id'],
            'location_id' => $fields['location_id'],
        ]);
        return [
            'message' => 'created successfully'
        ];
    }
}
