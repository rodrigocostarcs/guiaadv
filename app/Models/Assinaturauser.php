<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assinaturauser extends Model
{

    protected $table = 'assinatura_user';

    protected $fillable = [
    	'user_id',
    	'assinatura_id',
    	'inicio_assinatura',
    	'fim_assinatura',
    	'ativo',
    	'descricao',
    	'status'
    ];

}
