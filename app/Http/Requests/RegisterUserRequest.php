<?php

namespace App\Http\Requests;

class RegisterUserRequest  extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|unique:users|max:255',
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
            'email.unique' => 'O email precisa ser unico!',
            'password.required' => 'Você precisa especificar a senha!',
        ];
    }
}
