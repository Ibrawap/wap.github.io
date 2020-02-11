<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSongRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            // 'song_url' => 'nullable|string',
            // 'thumbnail_url' => 'nullable|string',
            'prefix' => 'nullable',
            'title' => 'required',
            'artiste' => 'required',
            'album_id' => 'nullable',
            'category_id' => 'required',
            'thumbnail' => 'nullable',
            'tags' => 'nullable',
            'desc' => 'required',
        ];
    }
}
