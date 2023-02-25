<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                return [];
            case 'DELETE':
                return [];

            case 'POST': {
                return [
                    'title' => 'required',
                    'category_id' => 'required|exists:categories,id',
                    'subcategory_id' => 'required',
                    'barcode' => 'nullable|unique:products',
                    'sku' => 'max:45',
                    'file' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                    'order' => 'required'
                ];
            }

            case 'PUT': {
                return [
                    'barcode' => 'required|unique:products,barcode,' . $this->product->id,
                    'sku' => 'max:45',
                    'detail' => 'required|max:255',
                    'file' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                    'category_id' => 'required',
                    'subcategory_id' => 'required',
                    'order' => 'required'
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'barcode.required' => 'Ingrese un código de barra',
            'barcode.unique' => 'El código de barra ya está en uso',

            'sku.max' => 'Ingresar menos de 45 dígitos',
            'detail.max' => 'Ingresar menos de 255 dígitos',
        ];
    }
}
