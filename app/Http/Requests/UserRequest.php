<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [
                    'direction' => ['in:asc,desc'],
                    'field' => ['in:name']
                ];

            case 'DELETE':
                return [];

            case 'POST': {
                    return [
                        'name' => 'required|max:40|unique:users',
                        'email' => 'required|max:255|unique:users',
                        'password' => 'required',
                        'role' => 'required|exists:roles,name'
                    ];
                }

            case 'PUT':
                return [
                    'name' => 'required|max:40|unique:users,name,'. $this->user->id,
                    'email' => 'required|max:255|unique:users,email,'. $this->user->id,
                    'role' => 'required|exists:roles,name'
                ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Ingrese Nombre de usuario',
            'name.unique' => 'El nombre de usuario está en uso',
            'email.required' => 'Ingrese correo electrónico de usuario',
            'email.unique' => 'El correo electrónico de usuario está en uso',
            'name.max' => 'Ingresar menos de 40 caracteres',
            'email.max' => 'Ingresar menos de 255 caracteres'
        ];
    }
}
