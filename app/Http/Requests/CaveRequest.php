<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'           => 'required|string',
            'monster.*.text' => 'required|string',
            'monster.*.status' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'monster.*.text.required' => 'The "Monster > Text" field is required.',
            'monster.*.status.required' => 'The "Monster > Status" field is required.',
        ];
    }
}
