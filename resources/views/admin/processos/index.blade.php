@extends('adminlte::page')

@section('title','Processos')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-3">
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
      
      <div class="col-sm-9">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
              
          </li>
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Processos</li>
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
                <th style="width: 10%">
                    Número do Processo
                </th>
                <th style="width: 20%">
                    Cliente
                </th>
                <th>
                    Data de encerramento
                </th>
                <th style="width: 50%">
                </th>
            </tr>
        </thead>
        @foreach($processos as $processo)
        <tbody>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        {{$processo->numero_processo}}
                    </a>
                    <br/>
                    <small>

                    </small>
                </td>
                <td>
                    <a>
                        Rodrigo
                    </a>
                </td>
                <td>
                    <a>
                       {{\Carbon\Carbon::parse($processo->data_encerramento)->format('d/m/Y')}}
                    </a>
                    <br/>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{route('processos.show',['processo'=>$processo->id])}}">
                        <i class="fas fa-folder">
                        </i>
                        Abrir Processo
                    </a>
                    <a class="btn btn-warning btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        Consultar prazos
                    </a>
                    <a class="btn btn-info btn-sm" href="{{route('processos.edit',['processo'=>$processo->id])}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Editar
                    </a>
                    <form class="d-inline" method="POST" action="{{route('processos.destroy',['processo'=>$processo->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
  </div>
   {{$processos->links()}}
   
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
@endsection