<?php

namespace App\Http\Requests\Quotation;

use Illuminate\Foundation\Http\FormRequest;

class PutQuotationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', 'exists:quotations,id'],
            'label' => ['required', 'string'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string']
        ];
    }

    /**
     * Attributes
     *
     * @return string[]
     */
    public function attributes()
    {
        return [
            'id' => 'Quotation',
            'customer_id' => 'Customer',
        ];
    }
}
