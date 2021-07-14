<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearHipotecaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        TODO:Implementar posible autenticación del usuario o validación del perfil
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
            "nombre" => "required",
            "apellidos" => "required",
            "email" => "required|email",
            "telefono" => "required|numeric|digits:9|starts_with:6,7,8,9",
            "ahorros_aportados" => "required|numeric|lt:precio_compra",
            "precio_compra" => "required|numeric|gt:ahorros_aportados"
        ];
    }
}
