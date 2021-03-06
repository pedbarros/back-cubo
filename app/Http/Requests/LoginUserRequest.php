<?php

namespace App\Http\Requests;

class LoginUserRequest  extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|max:255',
            'password' => 'required',
        ];
    }

    public function attributes()
    {
        return [];
    }

    public function messages()
    {
        return [
            'email.required' => 'Você precisa especificar o email!',
            'password.required' => 'Você precisa especificar a senha!',
        ];
    }
}
