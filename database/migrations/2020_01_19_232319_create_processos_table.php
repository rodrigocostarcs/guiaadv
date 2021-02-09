<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('numero_processo');
            $table->enum('status_processo',['deferido','indeferido','recurso','arquivado','aberto'])->default('aberto');
            $table->string('area_processo');
            $table->string('tipo_acao');
            $table->double('valor',10,2)->default(0);
            $table->date('data_encerramento')->nullable();
            $table->boolean('notificacao_email')->default(false);
            $table->text('observacao_processo')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('processos');
    }
}
