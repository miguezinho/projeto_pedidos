<?php

namespace App\Repositories;

use App\Models\PedidoStatus;
use App\Repositories\BaseRepository;

class PedidoStatusRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'descricao'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PedidoStatus::class;
    }
}
