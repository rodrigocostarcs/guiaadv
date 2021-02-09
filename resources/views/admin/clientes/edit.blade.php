@extends('adminlte::page')

@section('title','Editar Cliente')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                
                <h5> <i class="icon fas fa-ban"></i> Ocorreu um erro</h5>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                 @endforeach 
            </ul> 
        </div>
        @endif
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
              
          </li>
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Lista de Clientes</li>
          <li class="breadcrumb-item active">cliente {{$cliente->nome}}</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
<div class="col-md-4">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Dados Pessoa Física</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
       <!-- Formulário -->
       <form action="{{route('clientes.update',['cliente'=>encrypt($cliente->id)])}}" method="POST" class="form-horizontal">
       
         @method('PUT')
         @csrf
        <div class="form-group">
            <label for="inputName">Nome <span style="color:red;"> *</span></label>
            <input type="text" id="inputName" name="nome" value="{{$cliente->nome}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="inputName">CPF</label>
            <input type="text" name="cpf" value="{{$cliente->cpf}}" class="form-control @error('cpf') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">Data de Nascimento</label>
            <input type="date" name="nascimento" value="{{$cliente->nascimento}}" class="form-control @error('nascimento') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">RG</label>
            <input type="text" name="rg" value="{{$cliente->rg}}" class="form-control @error('rg') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">Profissão</label>
            <input type="text" name="profissao" value="{{$cliente->profissao}}" class="form-control @error('profissao') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">Pai</label>
            <input type="text" name="pai" value="{{$cliente->pai}}" class="form-control @error('pai') is-invalid @enderror">
        </div>
       
        <div class="form-group">
            <label for="inputName">Mãe</label>
            <input type="text" name="mae" value="{{$cliente->mae}}" class="form-control @error('mae') is-invalid @enderror">
        </div>
      
      <div class="form-group">
        <label for="inputStatus">Estado Civil</label>
        <select class="form-control custom-select" name="estado_civil" required>
          <option selected value="nenhum"></option>
          <option value="Solteiro">Solteiro</option>
          <option value="Casado">Casado</option>
          <option value="Divorciado">Divorciado</option>
          <option value="Divorciado">Viúvo</option>
        </select>
      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<div class="col-md-4">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Dados Pessoa Júridica</h3>
  
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="inputName">Razão Social</label>
          <input type="text" name="razao_social" value="{{$cliente->razao_social}}" class="form-control @error('razao_social') is-invalid @enderror" placeholder="Razão social caso o cliente seja empresa">
        </div>
        <div class="form-group">
          <label for="inputDescription">Responsável</label>
          <input type="text" name="responsavel" value="{{$cliente->responsavel}}" class="form-control @error('responsavel') is-invalid @enderror" placeholder="responsável pela empresa">
        </div>
        <div class="form-group">
          <label for="inputStatus">CNPJ</label>
          <input type="text" name="cnpj" value="{{$cliente->cnpj}}" class="form-control @error('cnpj') is-invalid @enderror" placeholder="CNPJ caso o cliente seja empresa">
        </div>
        <div class="form-group">
          <label for="inputClientCompany">Inscrição Estadual</label>
          <input type="text" name="inscricao_estadual" value="{{$cliente->inscricao_estadual}}" class="form-control @error('inscricao_estadual') is-invalid @enderror" placeholder="Inscrição Estadual caso o cliente seja empresa">
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

<div class="col-md-4">
  <div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Informações de Contato</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
     
      <div class="form-group">
        <label for="inputEstimatedBudget">Celular</label>
        <input type="text" name="celular" value="{{$cliente->celular}}" class="form-control @error('telefone') is-invalid @enderror">
      </div>
      <div class="form-group">
        <label for="inputSpentBudget">E-mail <span style="color:red;"> *</span></label>
        <input value="{{$cliente->email}}" type="email" name="email" class="@error('email') is-invalid @enderror form-control">
      </div>
      <div class="form-group">
        <label for="inputEstimatedDuration">CEP</label>
        <input type="text" name="cep" value="{{$cliente->cep}}" class="form-control @error('cep') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Bairro</label>
        <input type="text" name="bairro" value="{{$cliente->bairro}}" class="form-control @error('logradouro') is-invalid @enderror" placeholder="informar o endereço">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Logradouro</label>
        <input type="text" name="logradouro" value="{{$cliente->logradouro}}" class="form-control @error('logradouro') is-invalid @enderror" placeholder="informar o endereço">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Nº</label>
        <input type="text" name="n_casa" value="{{$cliente->n_casa}}" class="form-control @error('n_casa') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Cidade</label>
        <input type="text" name="cidade" value="{{$cliente->cidade}}" class="form-control @error('cidade') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Estado</label>
        <input type="text" name="estado" value="{{$cliente->estado}}" class="form-control @error('estado') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">complemento</label>
        <input type="text" name="complemento" value="{{$cliente->complemento}}" class="form-control @error('complemento') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Observação</label>
        <textarea id="inputDescription" class="form-control @error('observacao') is-invalid @enderror" name="observacao" rows="4">{{$cliente->observacao}}</textarea>
      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</div>
<div class="row">
<div class="col-12">
  <input type="submit" value="Alterar" class="btn btn-info btn-block float-right">
</div>
</form>
</div>
@endsection
