<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompromissosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compromissos', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('processo_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('status',['F','A','R'])->default('A');
            $table->date('data_compromisso');
            $table->time('horario_inicio')->nullable();
            $table->time('horario_fim')->nullable();
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
        Schema::dropIfExists('compromissos');
    }
}
