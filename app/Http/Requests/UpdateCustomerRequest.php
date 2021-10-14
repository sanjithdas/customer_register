<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCustomerRequest extends FormRequest
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
            'first_name' => 'required',
            'email' => 'required|email:rfc|unique:customers',
            'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages()
    {
        return [
            // 'first_name.required' => response("Name should be mandatory", 404),
            'first_name.required' => "First name is required",
            'email.required' => "Email is required",
            'email.email' => "Email should be a valid email",
            'phone.required' => "Phone number is required",
            'phone.regex' => 'Phone number should be in the valid format'
        ];
    }
}
