<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        return [
            'name'               => ['string', 'max:255'],
            'email'              => ['string', 'max:255', 'unique:users', 'email:rfc'],
            'password'           => ['confirmed', 'min:6'],
            'age'                => ['sometimes', 'numeric'],
            'profile_picture'    => ['sometimes', 'image', 'mimes:png,jpg,gif,svg', 'max:2048'],
            'linkedIn_url'       => ['sometimes', 'url', 'regex:' . $regex],
            'position'           => ['sometimes', 'string', 'max:255'],
            'bio'                => ['sometimes', 'string'],
            'points'             => ['sometimes', 'numeric']
        ];
    }
}
