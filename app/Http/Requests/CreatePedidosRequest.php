<?php

namespace App\Http\Requests;

use App\Models\Pedidos;
use Illuminate\Foundation\Http\FormRequest;

class CreatePedidosRequest extends FormRequest
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
        return Pedidos::$rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cliente_id.required' => "Preencha o cliente!",
            'produto.required' => "Preencha o produto!",
            'valor.required' => "Preencha o valor!",
            'data.required' => "Preencha a data!",
            'status_id.required' => "Preencha o status!",
            'ativo.required' => "Preencha se o pedido está ativo!",
        ];
    }
}
