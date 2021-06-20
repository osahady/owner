<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $user = auth();
        // return $user->hasAnyRole('admin', 'announcer');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'string|nullable',
            'price' => 'required|digits_between:1,7',
            'category_id' => 'required',
            'location_id' => 'required',
            'media.*' => 'mimetypes:video/*,image/*,audio/*|max:20480'
        ];
    }
}
