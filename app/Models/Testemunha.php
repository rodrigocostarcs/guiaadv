<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testemunha extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'rg','nascimento','profissao','estado_civil','telefone','celular','email','cep','logradouro','n_casa','bairro','complemento','cidade','estado','observacao'
    ];
}
