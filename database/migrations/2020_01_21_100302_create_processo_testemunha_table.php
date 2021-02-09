<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessoTestemunhaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processo_testemunha', function (Blueprint $table) {
            $table->increments('id');

             $table->integer('processo_id')->unsigned();
             $table->integer('testemunha_id')->unsigned();
             $table->foreign('processo_id')->references('id')->on('processos')->onDelete('cascade');
             $table->foreign('testemunha_id')->references('id')->on('testemunhas')->onDelete('cascade');

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
        Schema::dropIfExists('processo_testemunha');
    }
}
