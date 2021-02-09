<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    protected $fillable = ['tipo','cupom','valor','qtd_mes_cobranca','qtd_cad_basico','qtd_processos','financeiro','envio_email_prazos','envio_whatsapp_prazos','envio_email_compromissos','descricao_site','link','descricao_painel','ativo','identificador'];
}
