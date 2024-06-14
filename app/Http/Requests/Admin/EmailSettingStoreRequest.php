<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class EmailSettingStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'setting_key.SMTP_HOST' => 'required',
            'setting_key.SMTP_PORT' => 'required|integer',
            'setting_key.SMTP_USERNAME' => 'required',
            'setting_key.SMTP_PASSWORD' => 'required',
            'setting_key.FROM_EMAIL' => 'required|email',
            'setting_key.FROM_EMAIL_TITLE' => 'required',
            'setting_key.SMTP_SCHEME' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
