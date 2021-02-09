@extends('adminlte::page')

@section('title','Relatório da Testemunha')

@section('content_header')
    <h1>Relatório</h1>
@endsection

@section('content')
	 <div class="card">
        <div class="card-body">
           <h3>Dados Pessoais</h3>
            <p>Nome: {{$testemunha->nome}}</p>
            <p>CPF: {{$testemunha->cpf}}</p>
            <p>RG: {{$testemunha->rg}}</p>
            <p>Data de Nascimento: {{$testemunha->nascimento}}</p>
            <p>Profissão: {{$testemunha->profissao}}</p>
            <p>Estado Civil: {{$testemunha->estado_civil}}</p>
            
            <hr>
            <h3>Informações para Contato</h3>
            <p>Telefone: {{$testemunha->telefone}}</p>
            <p>Celular: {{$testemunha->celular}}</p>
            <p>E-mail: {{$testemunha->email}}</p>
            <hr>
            <h2>Endereço</h2>
            <p>CEP: {{$testemunha->cep}}</p>
            <p>Logradouro: {{$testemunha->logradouro}}</p>
            <p>Nº: {{$testemunha->n_casa}}</p>
            <p>Bairro: {{$testemunha->bairro}}</p>
            <p>Complemento: {{$testemunha->complemento}}</p>
            <p>Cidade: {{$testemunha->cidade}}</p>
            <p>Estado: {{$testemunha->estado}}</p>
            <hr>
            <h3>Observações</h3>
            <p>
                <pre>
                    {{$testemunha->observacao}}
                </pre>
            </p>
        </div>
    </div>
@endsection