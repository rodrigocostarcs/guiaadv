<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prazo extends Model
{
    protected $fillable = ['processo_id','data_prazo','descricao','status','user_id'];
}
