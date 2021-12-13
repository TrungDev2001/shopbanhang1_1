<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherValidator extends FormRequest
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
            'nameVoucher' => 'required',
            'codeVoucher' => 'required',
            'typeVoucher' => 'required',
            'numberVoucher' => 'required',
            'quantityVoucher' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nameVoucher.required' => 'Không được để trống',
            'codeVoucher.required' => 'Không được để trống',
            'typeVoucher.required' => 'Không được để trống',
            'numberVoucher.required' => 'Không được để trống',
            'quantityVoucher.required' => 'Không được để trống',
        ];
    }
}
