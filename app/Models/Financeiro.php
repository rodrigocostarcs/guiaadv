<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    protected $fillable = [
        'data_op', 'valor', 'tipo','descricao'
    ];
}
