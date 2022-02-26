<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class VoucherValidatorUpdate extends FormRequest
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
            // 'nameVoucher' => 'required|unique:vouchers,name',
            // 'codeVoucher' => 'required|unique:vouchers,code',
            'nameVoucher' => 'required',
            'codeVoucher' => 'required',
            'typeVoucher' => 'required',
            'numberVoucher' => 'required',
            'quantityVoucher' => 'required',
            'dateStartVoucher' => 'required',
            'dateEndVoucher' => 'required',
            // 'quantity_use_user_Voucher' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nameVoucher.required' => 'Không được để trống',
            //'nameProduct.unique' => 'Tên không được trùng nhau',
            'codeVoucher.required' => 'Không được để trống',
            //'codeVoucher.unique' => 'Code không được trùng nhau',
            'typeVoucher.required' => 'Không được để trống',
            'numberVoucher.required' => 'Không được để trống',
            'quantityVoucher.required' => 'Không được để trống',
            'dateStartVoucher.required' => 'Không được để trống',
            'dateEndVoucher.required' => 'Không được để trống',
            // 'quantity_use_user_Voucher.required' => 'Không được để trống',
        ];
    }
}
