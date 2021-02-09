@extends('adminlte::page')

@section('title','Novo Cliente')

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
          <li class="breadcrumb-item">Movimento Financeiro</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
<div class="col-md-12">
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Editar conta</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
       <!-- Formulário -->
       <form action="{{route('financeiros.update',['financeiro'=>$financeiro->id])}}" method="POST" class="form-horizontal">
        @method('PUT')
            @csrf

        <div class="form-group">
            <label for="inputName">Data da operação</label>
            <input type="date" id="inputName" name="data_op" value="{{$financeiro->data_op}}" class="form-control @error('data_op') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">Valor</label>
            <input type="text" name="valor" value="{{$financeiro->valor}}" class="form-control @error('valor') is-invalid @enderror">
        </div>

        <div class="form-group">
          <label for="tipo">Tipo de conta</label>
          <select name="tipo" id="tipo" class="form-control @error('descricao') is-invalid @enderror">
            <option value="R" @if($financeiro->tipo =='R') selected @endif>Contas a receber</option>
            <option value="P"  @if($financeiro->tipo =='P') selected @endif>Contas a pagar</option>
          </select>
      </div>


        <div class="form-group">
            <label for="inputName">Descrição da operação</label>
            <input type="text" name="descricao" value="{{$financeiro->descricao}}" class="form-control @error('descricao') is-invalid @enderror">
        </div>

        <div class="col-12">
            <input type="submit" value="Salvar" class="btn btn-success btn-block float-right">
          </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

</div>
</div>

@endsection

