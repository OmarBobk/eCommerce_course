<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
//        dd($this->validationData());
        switch ($this->method()) {
            // Store
            case 'POST':
            {
                return [
                    'code'         => 'required|unique:product_coupons',
                    'type'         => 'required',
                    'status'       => 'required',
                    'value'        => 'required',
                    'use_times'    => 'required|numeric',
                    'start_date'   => 'nullable|date_format:Y-m-d',
                    'expire_date'  => 'required_with:start_date|date_format:Y-m-d',
                    'greater_than' => 'nullable|numeric',
                    'description'  => 'nullable',
                ];
            }

            case 'PUT':
            case 'PATCH':
            {
                return [
                    'code'         => 'required|unique:product_coupons,code,'.$this->route()->product_coupon->id,
                    'type'         => 'required',
                    'value'        => 'required|numeric',
                    'use_times'    => 'required|numeric',
                    'start_date'   => 'nullable|date_format:Y-m-d',
                    'expire_date'  => 'required_with:start_date|date_format:Y-m-d',
                    'greater_than' => 'nullable|numeric',
                ];
            }

            default: break;
        }
    }
}
