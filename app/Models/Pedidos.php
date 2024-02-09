<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    public $table = 'pedidos';

    public $fillable = [
        'produto',
        'valor',
        'data',
        'cliente_id',
        'pedido_status_id',
        'ativo'
    ];

    protected $casts = [
        'produto' => 'string',
        'valor' => 'decimal:2',
        'data' => 'datetime',
        'ativo' => 'boolean'
    ];

    public static array $rules = [
        'produto' => 'required|string|max:255',
        'valor' => 'required|numeric',
        'data' => 'required',
        'cliente_id' => 'required',
        'pedido_status_id' => 'required',
        'ativo' => 'required|boolean'
    ];

    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Cliente::class, 'cliente_id');
    }

    public function pedidoStatus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PedidoStatus::class, 'pedido_status_id');
    }

    public function pedidosImagens(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PedidosImagen::class, 'pedido_id');
    }
}
