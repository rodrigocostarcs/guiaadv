<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssinaturaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assinatura_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('assinatura_id')->unsigned();
            $table->date('inicio_assinatura')->nullable();
            $table->date('fim_assinatura')->nullable();
            $table->boolean('ativo')->default(true);
            $table->text('descricao');
            $table->enum('status',['aprovado','pre-aprovado','aguardando','cancelado','periodo-teste','cortesia'])->default('pre-aprovado');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assinatura_id')->references('id')->on('assinaturas')->onDelete('cascade');
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
        Schema::dropIfExists('assinatura_user');
    }
}
