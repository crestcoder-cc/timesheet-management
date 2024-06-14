<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class CompanyStoreRequest extends FormRequest
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
            'person_name' => 'required',
//            'password' =>  'required_if:edit_value,0',

            'email' => [
                'required',
                Rule::unique('companies', 'email')
                    ->whereNull('deleted_at')
                    ->ignore($this->edit_value)
            ],
            'contact_no' => [
                'required',
                Rule::unique('companies', 'contact_no')
                    ->whereNull('deleted_at')
                    ->ignore($this->edit_value)
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
