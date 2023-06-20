<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
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
            'rotation_x' => ['required'],
            'rotation_y' => ['required'],
            'rotation_z' => ['required'],
            'ultrasonic' => ['required']
        ];
    }
}
