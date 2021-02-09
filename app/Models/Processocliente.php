<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processocliente extends Model
{
    

    protected $table = 'processo_cliente';

    protected $fillable = ['processo_id','cliente_id'];
}
