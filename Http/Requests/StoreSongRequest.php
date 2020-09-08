<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSongRequest extends FormRequest
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
            'prifix' => 'nullable|string',
            'title' => 'required|string',
            'tags' => 'nullable|string',
            'artiste' => 'required|string',
            'featuring' => 'nullable|string',
            'category_id' => 'required',
            'song_url' => 'required|string',
            'thumbnail_url' => 'required|string',
            'desc' => 'required|string',
        ];
    }
}
