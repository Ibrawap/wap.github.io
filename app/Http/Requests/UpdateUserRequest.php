<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username'  => ['required', 'string', 'max:15'],
            'firstname' => ['required', 'string', 'max:20'],
            'lastname'  => ['required', 'string', 'max:20'],
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('users')->ignore($this->user()->id),
            ],
            // 'password'  => ['required', 'string', 'min:3', 'confirmed'],
        ];
    }
}
