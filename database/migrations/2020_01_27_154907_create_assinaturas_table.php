<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssinaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assinaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('tipo');
            $table->integer('qtd_cad_basico');
            $table->integer('qtd_mes_cobranca');
            $table->integer('qtd_processos');
            $table->boolean('financeiro')->default(true);
            $table->boolean('envio_email_prazos')->default(false);
            $table->boolean('envio_whatsapp_prazos')->default(false);
            $table->boolean('envio_email_compromissos')->default(false);
            $table->text('descricao_painel');
            $table->text('descricao_site');
            $table->string('cupom')->nullable();
            $table->text('link');
            $table->string('identificador');
            $table->boolean('ativo')->default(true);
            $table->double('valor',10,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assinaturas');
    }
}
