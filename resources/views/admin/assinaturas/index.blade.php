@extends('adminlte::page')

@section('title','Lista de assinaturas disponível')

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
      <div class="col-sm-8">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
              
          </li>
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Assinaturas</li>
        </ol>
      </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-12">
          <div style="margin-left: 17px;">
              <a href="{{route('assinaturas.create')}}" class="btn btn-sm btn-info">criar nova assinatura</a>
          </div>
          
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
                    Assinatura
                </th>
                <th style="width: 15%">
                    Cadastros Básicos
                </th>
                <th>
                    Processos
                </th>
                <th>
                    Financeiro
                </th>
                <th style="width: 30%">
                </th>
            </tr>
        </thead>
        @foreach($assinaturas as $assinatura)
        <tbody>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        {!! $assinatura->tipo !!}
                    </a>
                    <br/>
                    <small>

                    </small>
                </td>
                <td>
                    <a>
                        {{$assinatura->qtd_cad_basico}}
                    </a>
                </td>
                <td>
                    <a>
                        {{$assinatura->qtd_processos}}
                    </a>
                </td>
                <td>
                    <a>
                        @if($assinatura->financeiro) <span>Sim</span> @else <span>Não</span> @endif
                    </a>
                </td>
                
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{route('assinaturas.show',['assinatura'=>encrypt($assinatura->id)])}}">
                        <i class="fas fa-folder">
                        </i>
                        Relatório
                    </a>
                    <a class="btn btn-info btn-sm" href="{{route('assinaturas.edit',['assinatura'=>encrypt($assinatura->id)])}}">
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
   {{$assinaturas->links()}}

@endsection
