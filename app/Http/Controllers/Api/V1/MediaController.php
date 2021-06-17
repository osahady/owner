<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function upload(Request $request, Ad $ad)
    {
        $fields = $request->validate([
            'path' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->file('path')) {
            $file = $request->file('path');
            $fileName = time().'_'.$file->getClientOriginalName();
            $location = 'media';
            //upload
            $path = $file->storeAs($location, $fileName);
            //store to db
            Media::create([
                'ad_id'=> $ad->id,
                'path'=> $path,
                'type'=> 'pic',
            ]);
            return [
                'message'=> 'uploaded successfully'
            ];
        }
    }
}
