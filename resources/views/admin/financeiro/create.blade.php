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
<div class="col-md-6">
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Lançar contas</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
       <!-- Formulário -->
        <form action="{{route('financeiros.store')}}" method="POST" class="form-horizontal">
            @csrf

        <div class="form-group">
            <label for="inputName">Data da operação</label>
            <input type="date" id="inputName" name="data_op" value="{{old('data_op')}}" class="form-control @error('data_op') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">Valor</label>
            <input type="text" name="valor" value="{{old('valor')}}" class="form-control @error('valor') is-invalid @enderror">
        </div>

        <div class="form-group">
          <label for="tipo">Tipo de conta</label>
          <select name="tipo" id="tipo" class="form-control @error('descricao') is-invalid @enderror">
            <option value="R">Contas a receber</option>
            <option value="P">Contas a pagar</option>
          </select>
      </div>


        <div class="form-group">
            <label for="inputName">Descrição da operação</label>
            <input type="text" name="descricao" value="{{old('descricao')}}" class="form-control @error('descricao') is-invalid @enderror">
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

<div class="col-md-6">
  <div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Últimas  movimentações</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      
        <!-- Timelime example  -->
        <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-red">17/01/2020</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-user bg-success"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i>12:05</span>
                    <h3 class="timeline-header"><a href="#">Conta a receber</a></h3>
  
                    <div class="timeline-body">
                      conta referente ao salário
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-primary btn-sm">Saiba mais</a>
                    </div>
                  </div>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i>12:05</span>
                    <h3 class="timeline-header"><a href="#">Conta a receber</a></h3>
  
                    <div class="timeline-body">
                      conta referente ao salário
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-primary btn-sm">Saiba mais</a>
                    </div>
                  </div>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i>12:05</span>
                    <h3 class="timeline-header"><a href="#">Conta a receber</a></h3>
  
                    <div class="timeline-body">
                      conta referente ao salário
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-primary btn-sm">Saiba mais</a>
                    </div>
                  </div>
                </div>
                <!-- END timeline item -->

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</div>

@endsection

