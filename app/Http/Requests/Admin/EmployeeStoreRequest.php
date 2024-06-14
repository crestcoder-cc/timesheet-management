<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class EmployeeStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'edit_value' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_no' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'department' => 'required',
            'address' => 'required',
            'password' =>  'required_if:edit_value,0',
            'email' => [
                'required',
                Rule::unique('employees', 'email')
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
