@extends('adminlte::page')

@section('title','Relatório do Cliente')

@section('content_header')
    <h1>Relatório</h1>
@endsection

@section('content')
	 <div class="card">
        <div class="card-body">
            
           <h3>Dados Pessoais</h3>
            <p>Nome: {{$contrario->nome}}</p>
            <p>CPF: {{$contrario->cpf}}</p>
            <p>RG: {{$contrario->rg}}</p>
            <p>Data de Nascimento: {{$contrario->nascimento}}</p>
            <p>Profissão: {{$contrario->profissao}}</p>
            <p>Estado Civil: {{$contrario->estado_civil}}</p>
            
            <hr>

            <h3>Informações para Contato</h3>
            <p>Telefone: {{$contrario->telefone}}</p>
            <p>Celular: {{$contrario->celular}}</p>
            <p>E-mail: {{$contrario->email}}</p>
            <hr>

            <h2>Endereço</h2>
            <p>CEP: {{$contrario->cep}}</p>
            <p>Logradouro: {{$contrario->logradouro}}</p>
            <p>Nº: {{$contrario->n_casa}}</p>
            <p>Bairro: {{$contrario->bairro}}</p>
            <p>Complemento: {{$contrario->complemento}}</p>
            <p>Cidade: {{$contrario->cidade}}</p>
            <p>Estado: {{$contrario->estado}}</p>
            <hr>

            <h3>Informações Empresarial</h3>
            <p>Razão Social: {{$contrario->razao_social}}</p>
            <p>Responsável pela empresa: {{$contrario-> responsavel}}</p>
            <p>CNPJ: {{$contrario-> cnpj}}</p>
            <p>Inscrição Estadual: {{$contrario->inscricao_estadual}}</p>
            <hr>
            <h3>Observações</h3>
            <p>
                <pre>
                    {{$contrario->observacao}}
                </pre>
            </p>
        </div>
    </div>
@endsection