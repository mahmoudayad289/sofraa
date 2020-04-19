<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
            'address' => 'string',
            'amount' => 'string',
            'notes' => 'string',
            'products' => 'required|string',
            'products.*' => 'required|string|exists:products,id',
            'statue' => 'required|string',
            'spacial_order' => 'string',
            'payment_method' => 'required|numeric',
            'restaurant_id' => 'required|exists:restaurants,id',
            'client_id' => 'required|exists:clients,id',
        ];
    }
}
