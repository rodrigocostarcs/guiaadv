<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $fillable = [

    	'processo_id',
    	'user_id',
    	'data_operacao',
    	'tipo_operacao',
    	'lancar_movimento',
    	'movimento_lancado',
    	'valor',
    	'descricao'
    ];
}
