<?php

namespace App\Http\Requests\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:profiles',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del perfil es requerido',
            'name.unique' => 'El nombre ya existe',
        ];
        
    }
}
