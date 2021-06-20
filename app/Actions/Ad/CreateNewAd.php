<?php

namespace App\Actions\Ad;

use App\Http\Requests\AdRequest;

class CreateNewAd
{
    public function create(AdRequest $request)
    {
        $fields = $request->validated();
        $user = $request->user();
        $ad = $user->ads()->create(
            // [
            //     'title' => $fields['title'],
            //     'body' => $fields['body'],
            //     'price' => $fields['price'],
            //     'category_id' => $fields['category_id'],
            //     'location_id' => $fields['location_id'],
            // ]
            $request->all()
        );
        $upload = new UploadFile();
        $res =  $upload->upload($request, $ad);

        return [
            'message' => 'Ad Was Created Successfully!',
            'media uploaded' => $res,
            'ad' => $ad->where('id', $ad->id)->with(['media'])->get(),

        ];
    }
}
