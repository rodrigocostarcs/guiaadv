<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compromisso extends Model
{
    protected $fillable = ['processo_id','user_id','status','data_compromisso','horario_inicio','horario_fim','descricao'];
}
