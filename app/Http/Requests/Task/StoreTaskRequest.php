<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'name'          => ['required', 'max:255'],
            'note'          => ['sometimes'],
            'state'         => ['required', Rule::in(['active', 'completed'])],
            'duration'         => ['required', Rule::in([30, 40, 90])],
            'due_date'      => ['required', 'date'],
            'kind'          => ['required', Rule::in(['daily', 'weekly', 'monthly'])],
            'reminder'      => ['sometimes', 'boolean'],
            'repeat'        => ['sometimes', 'boolean'],
        ];
    }
}
