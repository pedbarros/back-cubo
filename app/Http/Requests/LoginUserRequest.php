<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest  extends FormRequest
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
        return [
            /*'username'            => trans('userpasschange.username'),
            'oldpassword'             => trans('userpasschange.oldpassword'),
            'newpassword'             => trans('userpasschange.newpassword'),
            'newpasswordagain'       => trans('userpasschange.newpasswordagain'),*/
        ];
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
