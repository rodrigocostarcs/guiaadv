<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Contrarios;
use App\Models\Testemunhas;
use App\Models\Prazo;
use App\Models\Despesa;
use App\Models\Compromisso;

class Processo extends Model
{
    protected $fillable = ['numero_processo','status_processo','area_processo','tipo_acao','valor','data_encerramento','notificacao_email','observacao_processo'];

    
    public function clientes()
    {
    	return $this->belongsToMany(Cliente::class,'processo_cliente');
    }

    public function contrarios()
    {
    	return $this->belongsToMany(Contrario::class,'processo_contrario');
    }

    public function testemunhas()
    {
    	return $this->belongsToMany(Testemunha::class,'processo_testemunha');
    }

    public function prazos()
    {
        return $this->hasMany(Prazo::class);
    }

    public function despesas()
    {
        return $this->hasMany(Despesa::class);
    }

    public function compromissos()
    {
        return $this->hasMany(Compromisso::class);
    }
}
