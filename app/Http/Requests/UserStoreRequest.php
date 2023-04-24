<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'string|required|min:5',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'string|required|min:5',
            'mobile_no' => 'required|unique:users',
            'birthday_date' => 'required',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'fullname.string' => "Please enter valid Name",
    //         'email.string' => "Please enter valid Email",
    //         'password.string' => "Please enter valid Password",
    //     ];
    // }
}