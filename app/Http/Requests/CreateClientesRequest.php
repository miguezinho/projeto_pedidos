<?php

namespace App\Http\Requests;

use App\Models\Clientes;
use Illuminate\Foundation\Http\FormRequest;

class CreateClientesRequest extends FormRequest
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
        return Clientes::$rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => "Preencha o nome!",
            'cpf.required' => "Preencha o CPF!",
            'data_nasc.required' => "Preencha a data de nascimento!",
            'ativo.required' => "Preencha se o cliente está ativo!",
        ];
    }
}
