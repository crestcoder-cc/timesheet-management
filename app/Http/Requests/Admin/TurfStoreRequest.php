<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class TurfStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'edit_value' => 'required',
            'name' => 'required',
            'address' => 'required',
            'facility_provided' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')
                    ->whereNull('deleted_at')
                    ->ignore($this->edit_value)
            ],
            'mobile_no' => [
                'required',
                Rule::unique('users', 'mobile_no')
                    ->whereNull('deleted_at')
                    ->ignore($this->edit_value)
            ],
            'password' => 'required_if:edit_value,0',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
