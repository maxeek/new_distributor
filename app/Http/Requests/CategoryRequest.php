<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                        'name' => 'required|max:40',
                    ];
                }

            case 'PUT':
                return [
                    'name' => 'required|max:40|unique:categories,name,' . $this->category->id,

                ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Debe ingresar el nombre de la categoría',
            'name.max' => 'Debe ingresar menos de 40 caracteres',
        ];
    }
}
