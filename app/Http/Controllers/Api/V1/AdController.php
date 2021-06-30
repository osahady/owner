<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Ad\CreateNewAd;
use App\Actions\Ad\UploadFile;
use App\Models\Ad;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index(Request $request)
    {

        return AdResource::collection(
            Ad::limited($request)->get()
        );
    }

    public function catAds(Request $request, Category $cat)
    {
        return AdResource::collection(
            $cat->ads()
                ->with(['user', 'location', 'category'])
                ->limited($request)
                ->get()
        );
    }

    public function store(AdRequest $request)
    {
        $newAd = new CreateNewAd();
        return $newAd->create($request);
    }

    public function update(AdRequest $request, Ad $ad)
    {
        $this->authorize('update', $ad);
        $request->validated();

        if ($request->hasFile('media')) {
            $arr = $ad->media()->pluck('path')->toArray();
            Storage::delete($arr);
            $ad->media()->delete();
        }

        $update = new UploadFile();
        $update->upload($request, $ad);


        $ad->update($request->all());
        return [
            'message' => 'ad updated successfully'
        ];
    }

    public function delete(Ad $ad)
    {
        $this->authorize('delete', $ad);
        $ad->delete();
        return [
            'message' => 'Deleted successfully'
        ];
    }
}
