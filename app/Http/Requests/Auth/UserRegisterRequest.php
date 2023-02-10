<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
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
        'email' => 'required|string|email|unique:users,email|min:3|max:50',
        'name' => 'required|string|min:3|max:100',
        'password' => 'required|string|min:6|max:50|confirmed',
        'username' => 'required|string|min:3|max:50|unique:users,username',
    ];
}


    protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json(['message' => $validator->errors()->first()], 422));
}
}
