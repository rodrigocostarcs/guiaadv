@extends('adminlte::page')

@section('title','Parte Contrária')

@section('content_header')
    <h1>Lista das partes contrária cadasatradas no sistema</h1>
    
    <div class="card-header">
        <a href="{{route('contrarios.create')}}" class="btn btn-sm btn-success">Cadastrar nova parte contrária</a>
    @if(session('warning'))
        <br/><br/><br/>
        <div class="alert alert-info">
            
            <h5> <i class="icon fas fa-ban"></i>{{session('warning')}}</h5>
        
        </div>

    
    @endif
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach($contrarios as $contrario)
                <tbody>
                    <tr>
                        <td>{{$contrario->nome}}</td>
                        <td>{{$contrario->email}}</td>
                        <td>{{$contrario->celular}}</td>
                        <td>
                        <a href="{{route('contrarios.edit',['contrario'=>$contrario->id])}}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{route('contrarios.show',['contrario'=>$contrario->id])}}" class="btn btn-sm btn-info">Relatório</a>
                        <form class="d-inline" method="POST" action="{{route('contrarios.destroy',['contrario'=>$contrario->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
           </table>
        </div>
    </div>
   {{$contrarios->links()}}
@endsection