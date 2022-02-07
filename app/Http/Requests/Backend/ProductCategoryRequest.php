<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
     *
     */
    public function rules()
    {
        switch ($this->method()) {
            // Store
            case 'POST':
            {
                return [
                    'name'      => 'required|max:255|unique:product_categories,name',
                    'status'    => 'required',
                    'parent_id' => 'nullable',
                    'cover'     => 'required|mimes:jpg,jpeg,png|max:2000',
                ];
            }

            case 'PUT':
            case 'PATCH':
            {
                return [
                    1, 2
                ];
            }

            default: break;
        }
    }
}
