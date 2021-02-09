<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrario extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'rg','nascimento','profissao','estado_civil','telefone','celular','email','cep','logradouro','n_casa','bairro','complemento','cidade','estado','observacao','razao_social','responsavel','cnpj','inscricao_estadual'
    ];
}
