<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidosImagens extends Model
{
    public $table = 'pedidos_imagens';

    public $timestamps = false;

    public $fillable = [
        'pedido_id',
        'imagem',
        'capa'
    ];

    protected $casts = [
        'imagem' => 'string',
        'capa' => 'string'
    ];

    public static array $rules = [
        'pedido_id' => 'required',
    ];

    public function pedido(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Pedidos::class, 'pedido_id');
    }
}
