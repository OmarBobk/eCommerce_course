<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
        switch ($this->method()){
            case "POST":
                return [
                    'name'                     => 'required|max:255',
                    'description'              => 'max:255',
                    'price'                    => 'required|numeric',
                    'quantity'                 => 'required|numeric',
                    'featured'                 => 'required',
                    'status'                   => 'required',
                    'tags.*'                   => 'required',
                    'images'                   => 'required',
                    'images.*'                 => 'mimes:jpg,jpeg,png|max:3000',
                    'product_category_id'      => 'required',
                ];

            case "PUT":
            case "PATCH":
            return [
                'name'                     => 'required|max:255',
                'description'              => 'max:255',
                'price'                    => 'required|numeric',
                'quantity'                 => 'required|numeric',
                'featured'                 => 'required',
                'status'                   => 'required',
                'tags.*'                   => 'required',
                'images'                   => 'nullable',
                'images.*'                 => 'mimes:jpg,jpeg,png|mxa:3000',
                'product_category_id'      => 'required',
            ];

            default:break;
        }
    }
}
