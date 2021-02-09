<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('processo_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('data_operacao');
            $table->enum('tipo_operacao',['R','P'])->default('R');
            $table->enum('lancar_movimento',['S','N'])->default('N');
            $table->boolean('movimento_lancado')->default(0);
            $table->double('valor',10,2)->default(0);
            $table->string('descricao');
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
        Schema::dropIfExists('despesas');
    }
}
