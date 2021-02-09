@extends('adminlte::page')

@section('title','Clientes')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-4">
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="nome ou e-mail" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
                </button>
            </div>
            </div>
        </form>
      </div>
      <div class="col-sm-4">
        <a href="{{route('clientes.create')}}" class="btn btn-sm btn-success">Cadastrar novo Cliente</a>
        
        @if(session('success'))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: '{{session('success')}}',
              showConfirmButton: false,
              timer: 1500
            })
        </script>
   
        @endif

        @if(session('noautorizado'))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            Swal.fire({
              position: 'top-end',
              icon: 'info',
              title: '{{session('noautorizado')}}',
              showConfirmButton: false,
              timer: 1500
            })
        </script>
   
        @endif


      </div>
      <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
              
          </li>
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Clientes</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 20%">
                    Nome
                </th>
                <th style="width: 30%">
                    E-mail
                </th>
                <th>
                    Celular
                </th>
                <th style="width: 30%">
                </th>
            </tr>
        </thead>
        @foreach($clientes as $cliente)
        <tbody>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        {{$cliente->nome}}
                    </a>
                    <br/>
                    <small>

                    </small>
                </td>
                <td>
                    <a>
                        {{$cliente->email}}
                    </a>
                </td>
                <td>
                    <a>
                        {{$cliente->celular}}
                    </a>
                    <br/>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{route('clientes.show',['cliente'=>encrypt($cliente->id)])}}">
                        <i class="fas fa-folder">
                        </i>
                        Relatório
                    </a>
                    <a class="btn btn-info btn-sm" href="{{route('clientes.edit',['cliente'=>encrypt($cliente->id)])}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Editar
                    </a>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
  </div>
   {{$clientes->links()}}

@endsection
