<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class SocialMediaStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'setting_key.FACEBOOK_LINK' => 'required|url',
            'setting_key.INSTAGRAM_LINK' => 'required|url',
            'setting_key.TWITTER_LINK' => 'required|url',
            'setting_key.PINTEREST_LINK' => 'required|url',
            'setting_key.DRIBBLE_LINK' => 'required|url',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
