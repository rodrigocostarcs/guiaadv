<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prazos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('processo_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('data_prazo');
            $table->string('descricao');
            $table->enum('status',['aguardando','finalizado'])->default('aguardando');
            $table->foreign('processo_id')->references('id')->on('processos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('processos')->onDelete('cascade');
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
        Schema::dropIfExists('prazos');
    }
}
