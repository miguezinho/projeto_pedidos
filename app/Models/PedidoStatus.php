<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoStatus extends Model
{
    public $table = 'pedido_status';

    public $fillable = [
        'descricao'
    ];

    protected $casts = [
        'descricao' => 'string'
    ];

    public static array $rules = [
        'descricao' => 'required|string|max:255'
    ];

    public function pedidos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Pedido::class, 'pedido_status_id');
    }
}
