<?php

namespace App\Repositories;

use App\Models\PedidosImagens;
use App\Repositories\BaseRepository;

class PedidosImagensRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'pedido_id',
        'imagem',
        'capa'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PedidosImagens::class;
    }
}
