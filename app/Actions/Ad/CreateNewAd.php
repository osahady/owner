<?php

namespace App\Actions\Ad;

use App\Events\AdCreated;
use App\Http\Requests\AdRequest;

class CreateNewAd
{
    public function create(AdRequest $request)
    {
        $request->validated();
        $user = $request->user();
        $ad = $user->ads()->create(
            $request->all()
        );
        $upload = new UploadFile();
        $res =  $upload->upload($request, $ad);

        // event(new AdCreated($ad));
        AdCreated::dispatch($ad);

        return [
            'message' => 'Ad Was Created Successfully!',
            'media uploaded' => $res,
            'ad' => $ad->where('id', $ad->id)->with(['media'])->get(),

        ];
    }
}
