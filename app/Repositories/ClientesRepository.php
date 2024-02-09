<?php

namespace App\Repositories;

use App\Models\Clientes;
use App\Repositories\BaseRepository;

class ClientesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nome',
        'cpf',
        'data_nasc',
        'telefone',
        'ativo'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Clientes::class;
    }
}
