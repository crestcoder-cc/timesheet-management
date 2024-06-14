<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class ContactInfoStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'setting_key.CONTACT_NUMBER_1' => 'required',
            'setting_key.CONTACT_NUMBER_2' => 'required',
            'setting_key.WHATSAPP_NUMBER' => 'required',
//            'setting_key.ADDRESS_GOOGLE_MAP' => 'required',
            'setting_key.ADDRESS_1' => 'required',
            'setting_key.ADDRESS_2' => 'required',
            'setting_key.COUNTRY' => 'required',
            'setting_key.STATE' => 'required',
            'setting_key.CITY' => 'required',
            'setting_key.ZIPCODE' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
