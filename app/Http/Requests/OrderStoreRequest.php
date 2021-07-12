<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'quantity' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'product_id' => ['required', 'exists:products,id'],
            'order_category_id' => ['required', 'exists:order_categories,id'],
            'menu_type_id' => ['required', 'exists:menu_types,id'],
        ];
    }
}
