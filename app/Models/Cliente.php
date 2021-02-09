<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Processo;

class Cliente extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'rg','nascimento','profissao','estado_civil','pai','mae','celular','email','cep','logradouro','n_casa','bairro','complemento','cidade','estado','observacao','razao_social','responsavel','cnpj','inscricao_estadual'
    ];

 	
 	public function processos()
    {
    	return $this->belongsToMany(Processo::class,'processo_cliente');
    }

}
