<?php

namespace App\Http\Requests\Exercise;

use Illuminate\Foundation\Http\FormRequest;

class StoreExerciseRequest extends FormRequest
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
            'name'        => ['required', 'max:255'],
            'description' => ['required'],
            'body_part'   => ['required'],
            'repetitions' => ['required', 'numeric'],
            'sets'        => ['required', 'numeric'],
            'duration'    => ['required', 'numeric'],
            'link'        => ['sometimes', 'url', 'regex:'.$regex],
            'cover'       => ['sometimes', 'image', 'mimes:png,jpg,gif,svg', 'max:2048'],
        ];
    }
}
