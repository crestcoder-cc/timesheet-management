<?php

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class TaskStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project'    => 'required',
            'client_id' => 'required',
            'description' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
        ];
    }

    public function failedValidation( Validator $validator )
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
