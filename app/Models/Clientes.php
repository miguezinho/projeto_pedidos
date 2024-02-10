<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    public $table = 'clientes';

    public $timestamps = false;

    public $fillable = [
        'nome',
        'cpf',
        'data_nasc',
        'telefone',
        'ativo'
    ];

    protected $casts = [
        'nome' => 'string',
        'cpf' => 'string',
        'data_nasc' => 'datetime',
        'telefone' => 'string',
        'ativo' => 'boolean'
    ];

    public static array $rules = [
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|max:15',
        'data_nasc' => 'required',
        'telefone' => 'nullable|string|max:15',
        'ativo' => 'required|boolean'
    ];

    public function pedidos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Pedidos::class, 'cliente_id');
    }
}
