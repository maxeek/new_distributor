<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function true()
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
                    'field' => ['in:name,surname,business_name']
                ];

            case 'DELETE':
                return [];

            case 'POST': {
                    return [
                        'cuit' => 'required|unique:clients',
                        'business_name' => 'required|max:40',
                        'surname' => 'max:40',
                        'cuit' => 'min:2',
                        'name' => 'max:40',
                        'address' => 'max:40',
                        'email' => 'max:255',
                        'phone' => 'max:20',
                    ];
                }

            case 'PUT':
                return [
                    'cuit' => 'required|unique:clients,cuit,'. $this->client->id,
                    'business_name' => 'required|max:40',
                    'surname' => 'max:40',
                    'name' => 'max:40',
                    'address' => 'max:40',
                    'email' => 'max:255',
                    
                    'phone' => 'max:20',
                ];
        }
    }

    public function messages()
    {
        return [
            'cuit.required' => 'Ingrese CUIT',
            'cuit.unique' => 'El CUIT ya está en uso',
            'cuit.min' => 'Ingresé CUIT',
            'business_name.required' => 'Ingrese nombre de la empresa',
            'business_name.max' => 'Ingresar menos de 40 caracteres',
            'surname.max' => 'Ingresar menos de 40 caracteres',
            'name.max' => 'Ingresar menos de 40 caracteres',
            'email.max' => 'Ingresar menos de 40 caracteres',
            'phone.max' => 'Ingresar menos de 20 caracteres',
        ];
    }
}
