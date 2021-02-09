<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processocontrario extends Model
{
    protected $fillable = ['processo_id','contrario_id'];

    protected $table = 'processo_contrario';
}
