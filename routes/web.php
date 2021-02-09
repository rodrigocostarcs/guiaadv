<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/','Site\HomeController@index');
    

    Route::prefix('painel')->group(function(){


    Route::get('/','Admin\HomeController@index')->name('admin');

    /** PERFIL DO USUÁRIO E ASSINATURA **/

    //ALTERAR E EDITAR PERFIL
    Route::get('perfil','Admin\PerfilController@index')->name('perfil');
    Route::put('perfi/editar','Admin\PerfilController@alterarDados')->name('perfil.editar');


    //MOSTRAR ASSINATURA
    Route::get('perfil/assinatura','Admin\PerfilController@perfilAssinatura')->name('perfil.assinatura');

    /** FIM PERFIL **/

   /****** INÍCIO REQUISIÇÕES AJAX  *****/
    //deletar cliente via requisição ajax
    Route::post('deletar/cliente','Admin\ClienteController@deletarCliente');
   /*****   FIM   REQUISIÇÕES AJAX   *****/

    
   /****** INÍCIO CADASTRO, REGISTRO E LOGOUT *****/
    Route::get('login','Admin\Auth\LoginController@index')->name('login');
    Route::post('login','Admin\Auth\LoginController@authenticate');

    Route::get('register','Admin\Auth\RegisterController@index')->name('register');
    Route::post('register','Admin\Auth\RegisterController@register');
    Route::post('logout','Admin\Auth\LoginController@logout')->name('logout');
    /*****   FIM   CADASTRO, REGISTRO E LOGOUT   *****/


    /****** INÍCIO ADICIONAR CLIENTE AO PROCESSO, EXIBIR E EXCLUIR *****/

    //exibe os cliente para adicionar no  processo
    Route::get('processo/adicionar/{id}/cliente','Admin\ConsultaProcessoController@processoCliente')->name('addclienteprocesso');
    //cadastra os clientes no processo processo
    Route::post('processo/salvar/{id}/cliente','Admin\ConsultaProcessoController@salvarProcessoCliente')->name('salvarclienteprocesso');
    //Deleta o cliente do processo
    Route::delete('processo/deletar/cliente/{idCliente}/processo/{idProcesso}','Admin\ConsultaProcessoController@deletarProcessoCliente')->name('processoclientedeleta');
    /****** FIM ADICIONAR CLIENTE AO PROCESSO, EXIBIR E EXCLUIR *****/


    /****** INÍCIO ADICIONAR TESTEMUNHA AO PROCESSO, EXIBIR E EXCLUIR *****/
    //consulta processo
    Route::get('processo/adicionar/{id}/testemunha','Admin\ConsultaProcessoController@processoTestemunha')->name('addtestemunhaeprocesso');
    Route::post('processo/salvar/{id}/testemunha','Admin\ConsultaProcessoController@salvarProcessoTestemunha')->name('salvartestemunhaprocesso');
    Route::delete('processo/deletar/testemunha/{idTestemunha}/processo/{idProcesso}','Admin\ConsultaProcessoController@deletarProcessoTestemunha')->name('processotestemunhadeleta');
     /****** FIM ADICIONAR TESTEMUNHA AO PROCESSO, EXIBIR E EXCLUIR *****/




     /****** INÍCIO ADICIONAR CONTRARIO AO PROCESSO, EXIBIR E EXCLUIR *****/
    //consulta processo
    Route::get('processo/adicionar/{id}/contrario','Admin\ConsultaProcessoController@processoContrario')->name('addcontrarioprocesso');
    Route::post('processo/salvar/{id}/contrario','Admin\ConsultaProcessoController@salvarProcessoContrario')->name('salvarcontrarioprocesso');
    Route::delete('processo/deletar/contrario/{idContrario}/processo/{idProcesso}','Admin\ConsultaProcessoController@deletarProcessoContrario')->name('processocontrariodeleta');
    /****** FIM ADICIONAR CONTRARIO AO PROCESSO, EXIBIR E EXCLUIR *****/




    /****** INÍCIO PRAZO EXIBIR ADICIONAR PRAZO AO PROCESSO E CADASTRAR*****/
    
    Route::get('processo/adicionar/{id}/prazo','Admin\PrazoController@addPrazoExibir')->name('addprazo');
    Route::post('processo/adicionar/{id}/prazo','Admin\PrazoController@addPrazoCadastrar')->name('addprazostore');
    /****** FIM PRAZO EXIBIR ADICIONAR PRAZO AO PROCESSO E CADASTRAR*****/

    /****** INÍCIO DESPESAS EXIBIR, ADICIONAR,ALTERAR E DELETAR AO PROCESSO *****/
    //exibir cadastro das despesas
    Route::get('processo/adicionar/{id}/despesa','Admin\DespesaController@addDespesaExibir')->name('adddespesa');
    Route::post('processo/adicionar/{id}/despesa','Admin\DespesaController@addDespesaCadastrar')->name('adddespesastore');
    Route::get('processo/exibir/{id}/despesa','Admin\DespesaController@alterarDespesa')->name('alterardespesa');
    Route::put('processo/despesa/alterar/{id}','Admin\DespesaController@salvarDespesaAlterada')->name('adddespesa.save');
    Route::delete('processo/despesa/deletar/{id}','Admin\DespesaController@deletarDespesa')->name('despesa.destroy');
    /****** FIM DESPESAS EXIBIR, ADICIONAR,ALTERAR E DELETAR AO PROCESSO*****/


    /****** INÍCIO COMPROMISSOS EXIBIR, ADICIONAR,ALTERAR E DELETAR AO PROCESSO *****/
    //exibir cadastro de compromisso
    Route::get('processo/adicionar/{id}/compromisso','Admin\CompromissoController@addCompromissoExibir')->name('addcompromisso');
    Route::post('processo/adicionar/{id}/compromisso','Admin\CompromissoController@addCompromissoCadastrar')->name('addcompromissostore');
    Route::get('processo/exibir/{id}/compromisso','Admin\CompromissoController@alterarCompromisso')->name('alterarcompromisso');
   Route::put('processo/compromisso/alterar/{id}','Admin\CompromissoController@salvarCompromissoAlterado')->name('addcompromisso.save');
    Route::delete('processo/compromisso/deletar/{id}','Admin\CompromissoController@deletarCompromisso')->name('compromisso.destroy');
    /****** FIM DESPESAS EXIBIR, ADICIONAR,ALTERAR E DELETAR AO PROCESSO*****/

     /****** INÍCIO ROTAS RESOURCES  *****/
  
    Route::resource('clientes','Admin\ClienteController');
    Route::resource('testemunhas','Admin\TestemunhaController');
    Route::resource('contrarios','Admin\ContrarioController');
    Route::resource('financeiros','Admin\FinanceiroController');
    Route::resource('processos','Admin\ProcessoController');
    Route::resource('assinaturas','Admin\AssinaturaController');
   /****** FIM ROTAS RESOURCES*****/


});