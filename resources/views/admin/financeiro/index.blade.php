@extends('adminlte::page')

@section('title','Novo Cliente')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      
      <div class="col-sm-8">
        <!-- SEARCH FORM -->
        <form class="form-inline ml-6">
            <div class="input-group input-group-sm">
            <label for="">Início / </label> 
            <input class="form-control form-control-navbar" type="date"  aria-label="Search">
            <label for="">Fim / </label>
            <input class="form-control form-control-navbar" type="date" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
                </button>
            </div>
            </div>
        </form>
      </div>

      <div class="col-sm-4">
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
<!-- TABLE: LATEST ORDERS -->
<div class="row">
<div class="col-md-8">
<div class="card">
    <div class="card-header border-transparent">
    <h3 class="card-title">Todos Lançamentos do períoo {{\Carbon\Carbon::parse($data_begin)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($data_end)->format('d/m/Y')}}</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
          <tr>
            <th>Data da Operação</th>
            <th>Tipo de Operação</th>
            <th>Valor</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr>
            @foreach($financas as $financa)
            <td>{{\Carbon\Carbon::parse($financa->data_op)->format('d/m/Y')}}</td>
            <td>
                @if($financa->tipo == 'P')
                <span class="badge badge-danger">
                    Contas a pagar
                @else
                <span class="badge badge-success">
                     Contas a receber 
                @endif
                </span>
            </td>
            <td>
            <div class="sparkbar" data-color="#00a65a" data-height="20">R$ {{$financa->valor}}</div>
            </td>
            <td class="project-actions text-right">

                <a class="btn btn-info btn-sm" href="{{route('financeiros.edit',['financeiro'=>$financa->id])}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Editar
                </a>
                <form class="d-inline" method="POST" action="{{route('financeiros.destroy',['financeiro'=>$financa->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
<div class="col-md-4">
    <div class="info-box bg-info">
        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Saldo</span>
          <span class="info-box-number">R$ {{$saldo}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            Saldo com base na pesquisa realizada ao lado
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>    
</div>
</div>
{{$financas->links()}}
@endsection