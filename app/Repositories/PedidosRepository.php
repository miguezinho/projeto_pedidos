<?php

namespace App\Repositories;

use App\Models\Pedidos;
use App\Repositories\BaseRepository;

class PedidosRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'produto',
        'valor',
        'data',
        'cliente_id',
        'pedido_status_id',
        'ativo'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Pedidos::class;
    }
}
