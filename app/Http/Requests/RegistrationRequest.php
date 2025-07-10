<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'full_name' => 'required|regex:/^[a-zA-Z ]*$/',
            'username' => 'required|unique:users|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|digits:10',
            'whatsapp_number' => 'required|digits:10',
            'address' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',      // Lowercase
                'regex:/[A-Z]/',      // Uppercase
                'regex:/[0-9]/',      // Number
                'regex:/[@$!%*#?&]/'  // Special char
            ],
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png,gif|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password must contain at least 1 uppercase, 1 lowercase, 1 number, and 1 special character.',
        ];
    }
}