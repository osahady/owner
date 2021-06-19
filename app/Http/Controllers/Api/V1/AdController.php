<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Models\Media\Audio;
use App\Models\Media\Image;
use App\Models\Media\Video;
use Illuminate\Support\Facades\Storage;

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
        $ad = $user->ads()->create([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'price' => $fields['price'],
            'category_id' => $fields['category_id'],
            'location_id' => $fields['location_id'],
        ]);
        $res = $this->upload($request, $ad);
        return [
            'message' => 'Ad was created successfully',
            'media uploaded' => $res,
            'ad' => $ad,

        ];
    }

    private function upload(AdRequest $request, Ad $ad)
    {
        if ($request->hasFile('media')) {
            $files = $request->file('media');
            foreach ($files as $key => $file) {

                $fileName = $file->getClientOriginalName();
                $location = 'public'; //storage/app/public
                $path = $file->storeAs($location, $fileName);

                $this->checkAndStore($file, $ad, $path);
            }

            return [
                'message' => 'media uploaded',
                'status' => 'success',
            ];
        } else {
            return [
                'message' => 'media not uploaded',
            ];
        }
    }

    private function checkAndStore($file, Ad $ad, $path)
    {
        $url = Storage::url($path);
        $arr = explode('/', $file->getClientMimeType());
        switch ($arr[0]) {
            case 'video':
                $video = Video::create();

                $a = [
                    'type' => 'video',
                    'id' => $video->id,
                ];
                break;
            case 'audio':
                $audio = Audio::create();
                $a = [
                    'type' => 'audio',
                    'id' => $audio->id,
                ];
                break;

            default:
                $image = Image::create();
                $a = [
                    'type' => 'image',
                    'id' => $image->id,
                ];
                break;
        }
        return $ad->media()->create([
            'path' => $path,
            'url' => $url,
            'mediable_type' => $a['type'],
            'mediable_id' => $a['id'],
        ]);
    }
}
