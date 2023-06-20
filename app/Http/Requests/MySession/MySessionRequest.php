<?php

namespace App\Http\Requests\MySession;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MySessionRequest extends FormRequest
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
            'name'       => ['required', 'max:255'],
            'state'         => ['required', Rule::in(['active', 'completed'])],
            'start_time' => ['required', 'date'],
            'end_time'   => ['required', 'date', 'after:start_time']
        ];
    }
}
