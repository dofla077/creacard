<?php

namespace App\Http\Requests\Quotation;

use Illuminate\Foundation\Http\FormRequest;

class PostQuotationRequest extends FormRequest
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
     * Attributes
     * @return string[]
     */
    public function attributes()
    {
        return ['customer_id' => 'Customer'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'label' => ['required', 'string'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string']
        ];
    }
}
