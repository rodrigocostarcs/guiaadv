<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processotestemunha extends Model
{
    protected $table = 'processo_testemunha';

    protected $fillable = ['processo_id','testemunha_id'];

}
