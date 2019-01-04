<?php

namespace App\Http\Requests;


class InformationStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'participation' => 'required|numeric|min:1|max:100',
        ];
    }

    public function attributes()
    {
        return [];
    }

    public function messages()
    {
        return [
            'firstName.required' => 'Você precisa especificar o primeiro nome!',
            'lastName.required' => 'Você precisa especificar o ultimo nome!',
            'participation.required' => 'Você precisa especificar a participação!',
            'participation.min' => 'Você precisa especificar a participação com o minino valor 1!',
            'participation.max' => 'Você precisa especificar a participação com o máximo valor 100!',
        ];
    }
}
