<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'owner'         => 'required|integer|exists:owners,id',
            'series'        => 'required|string',
            'number'        => 'required|integer',
            'issuance_date' => 'required|date',
            'due_date'      => 'nullable|date',

            'items'               => 'required',
            'items.*.order'       => 'nullable|integer',
            'items.*.description' => 'required|string',
            'items.*.quantity'    => 'required|numeric',
            'items.*.unit_price'  => 'required|numeric',
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
            //
        ];
    }
}
