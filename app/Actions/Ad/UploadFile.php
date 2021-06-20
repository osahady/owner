<?php

namespace App\Actions\Ad;

use App\Models\Ad;
use App\Models\Media\Audio;
use App\Models\Media\Image;
use App\Models\Media\Video;
use App\Http\Requests\AdRequest;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public function upload(AdRequest $request, Ad $ad)
    {
        if ($request->hasFile('media')) {
            $files = $request->file('media');
            foreach ($files as $key => $file) {

                $fileName = time() . '_' . $file->getClientOriginalName();
                $location = 'public/ads/' . $request->category_id; //storage/app/public
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
